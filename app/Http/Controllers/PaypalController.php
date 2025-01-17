<?php

namespace App\Http\Controllers;

use App\Mail\BookingSuccessMail;
use App\Models\Bookings;
use App\Models\Buildings;
use App\Models\Rooms;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Omnipay\Omnipay;

class PaypalController extends Controller
{
    protected $googleCalendarController;
    private $gateway;
    public function __construct(GoogleCalendarController $googleCalendarController)
    {
        $this->googleCalendarController = $googleCalendarController;
        $this->gateway = Omnipay::create('PayPal_Rest');
        $this->gateway->setClientId(env('PAYPAL_CLIENT_ID'));
        $this->gateway->setSecret(env('PAYPAL_CLIENT_SECRECT'));
        $this->gateway->setTestMode(true);
    }

    public function paypalPayment(Request $request)
    {
        try {
            $bookingInfo = $request->all();
            $response = $this->gateway->purchase(array(
                'amount' => $bookingInfo['totalPrice'],
                'currency' => 'USD',
                'returnUrl' => route('paypal.return'), // Điều chỉnh để sử dụng route name
                'cancelUrl' => route('paypal.cancel'), // Điều chỉnh để sử dụng route name
            ))->send();

            if ($response->isRedirect()) {
                $getResponse = $response->getData();
                Transaction::create([
                    'user_id' => Auth::user()->id,
                    'transaction_id' => $getResponse['id'],
                    'payment_method' => $bookingInfo['payment_method'],
                    'currency' => 'USD',
                    'status' => 'pending',
                    'room_id' => $bookingInfo['room_id'],
                    'price' => $bookingInfo['price'],
                    'tax' => $bookingInfo['tax'],
                    'totalPrice' => $bookingInfo['totalPrice'],
                    'startAt' => Carbon::createFromFormat('m/d/Y', $bookingInfo['startAt'])->toDateString(),
                    'endAt' => Carbon::createFromFormat('m/d/Y', $bookingInfo['endAt'])->toDateString(),
                    'bookingType' => $bookingInfo['bookingType'],
                    'sessionType' => $bookingInfo['sessionType'],
                    'userName' => $bookingInfo['userName'],
                    'userPhone' => $bookingInfo['userPhone'],
                    'userEmail' => $bookingInfo['userEmail'],
                ]);

                // Chuyển hướng đến PayPal để người dùng hoàn thành thanh toán
                $response->redirect();
            } else {
                // Nếu không thể redirect, hiển thị lỗi và trả về view
                return view('booking.checkout-return', [
                    'error' => $response->getMessage(),
                ]);
            }
        } catch (\Exception $e) {
            // Xử lý lỗi khi tạo thanh toán
            return view('booking.checkout-return', [
                'error' => $e->getMessage(),
            ]);
        }
    }

    public function paypalReturn(Request $request)
    {
        try {
            $response = $this->gateway->completePurchase([
                'payerId' => $request->PayerID,
                'transactionReference' => $request->paymentId,
            ])->send();

            if ($response->isSuccessful()) {
                $getResponse = $response->getData();

                // Tìm transaction dựa trên transaction_id, payment_method và status
                $transaction = Transaction::where('transaction_id', $getResponse['id'])
                    ->where('payment_method', 'paypal')
                    ->where('status', 'pending')
                    ->first();

                if (!$transaction) {
                    return view('booking.checkout-return')->with('error', 'Transaction not found.');
                }

                DB::beginTransaction();
                try {
                    $room = Rooms::findOrFail($transaction->room_id);
                    $user = Auth::user();

                    $startAt = Carbon::parse($transaction->startAt);
                    $endAt = Carbon::parse($transaction->endAt);

                    switch ($transaction->sessionType) {
                        case 'All day':
                            $startAt->setTime(8, 0);
                            $endAt->setTime(22, 0);
                            break;
                        case 'Morning':
                            $startAt->setTime(8, 0);
                            $endAt->setTime(12, 0);
                            break;
                        case 'Afternoon':
                            $startAt->setTime(13, 0);
                            $endAt->setTime(17, 0);
                            break;
                        case 'Evening':
                            $startAt->setTime(18, 0);
                            $endAt->setTime(22, 0);
                            break;
                    }

                    // Tạo booking mới
                    $booking = Bookings::create([
                        'user_id' => $transaction->user_id,
                        'room_id' => $transaction->room_id,
                        'tax' => $transaction->tax,
                        'totalPrice' => $transaction->totalPrice,
                        'status' => 'approved',
                        'userName' => $transaction->userName,
                        'userEmail' => $transaction->userEmail,
                        'userPhone' => $transaction->userPhone,
                        'payment_method' => $transaction->payment_method,
                        'currency' => 'USD',
                        'startAt' => $transaction->startAt,
                        'endAt' => $transaction->endAt,
                        'bookingType' => $transaction->bookingType,
                        'sessionType' => $transaction->sessionType,
                    ]);

                    // Thêm thông tin transaction
                    $transaction->booking_id = $booking->id;
                    $transaction->startAt = $startAt->toDateTimeString();
                    $transaction->endAt = $endAt->toDateTimeString();
                    $transaction->payment_data = json_encode($getResponse);
                    $transaction->status = 'success';
                    $transaction->updated_at = now();
                    $transaction->save();

                    // Lấy thông tin Buildings
                    $building = Buildings::where('id', $room->building_id)->first();

                    // Gửi email
                    Mail::to($transaction->userEmail)->send(new BookingSuccessMail($booking, $room, $building));

                    // *** BẮT ĐẦU TẠO EVENT CALENDAR ***
                    $this->googleCalendarController->createCalendarEvent($transaction, $room, $building, $booking);
                    // *** KẾT THÚC TẠO EVENT CALENDAR ***

                    DB::commit();
                    return view('booking.checkout-return', data: compact('getResponse'));
                } catch (\Exception $e) {
                    DB::rollBack();
                    dd($e);
                    return view('booking.checkout-return')->with('error', 'Booking failed. Please try again.');
                }

                // Thanh toán thành công, trả về view
                // return view('booking.checkout-return', [
                //     'success' => true,
                //     'data' => $response->getData(),
                // ]);
            } else {
                // Thanh toán không thành công
                dd($response);
                return view('booking.checkout-return', [
                    'success' => false,
                    'error' => $response->getMessage(),
                ]);
            }
        } catch (\Exception $e) {
            dd($e);
            // Xử lý lỗi khi hoàn tất thanh toán
            return view('booking.checkout-return', [
                'error' => $e->getMessage(),
            ]);
        }
    }

    public function paypalCancel()
    {
        return view('booking.checkout-return', [
            'success' => false,
            'error' => 'You have canceled the payment.',
        ]);
    }
}
