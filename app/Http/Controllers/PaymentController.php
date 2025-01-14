<?php

namespace App\Http\Controllers;

use App\Mail\BookingSuccessMail;
use App\Models\Buildings;
use App\Models\Transaction;
use App\Models\Bookings;
use App\Models\Rooms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\GoogleCalendarController;


class PaymentController extends Controller
{
    protected $googleCalendarController;

    public function __construct(GoogleCalendarController $googleCalendarController)
    {
        $this->googleCalendarController = $googleCalendarController;
    }

    public function vnpayPayment(Request $request)
    {
        $bookingInfo = $request->all();

        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = route('payment.return');
        $vnp_TmnCode = "WXTK4S85"; //Mã website tại VNPAY
        $vnp_HashSecret = "KMX885Z0XZDJNG5CNMH7089PTCTOM39B"; //Chuỗi bí mật
        $vnp_TxnRef = Str::uuid();
        $vnp_OrderInfo = "Thanh toan hoa don " . $vnp_TxnRef;
        $vnp_OrderType = "billpayment";
        $vnp_Amount = $bookingInfo['totalPrice'] * 100;
        $vnp_Locale = "VN";
        $vnp_BankCode = "NCB";
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }
        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret); //
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }

        $returnData = array(
            'code' => '00'
            ,
            'message' => 'success'
            ,
            'data' => $vnp_Url
        );

        // Tạo transaction
        Transaction::create([
            'user_id' => Auth::user()->id,
            'transaction_id' => $vnp_TxnRef,
            'payment_method' => $bookingInfo['payment_method'],
            'currency' => 'VND',
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

        header('Location: ' . $vnp_Url);
        die();
    }

    public function checkoutReturn(Request $request)
    {
        $code = $request->all();
        $vnp_HashSecret = "KMX885Z0XZDJNG5CNMH7089PTCTOM39B";
        $vnp_SecureHash = $request->get('vnp_SecureHash');
        $inputParams = $request->except('vnp_SecureHash');
        ksort($inputParams);
        $hashData = "";
        $i = 0;
        foreach ($inputParams as $key => $value) {
            if ($i == 1) {
                $hashData .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashData .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
        }
        $vnp_SecureHashVerify = hash_hmac('sha512', $hashData, $vnp_HashSecret);

        if ($vnp_SecureHashVerify == $vnp_SecureHash) {
            $vnp_txn_ref = $request->get('vnp_TxnRef');
            $vnp_order_info = $request->get('vnp_OrderInfo');

            // Tìm transaction dựa trên transaction_id, payment_method và status
            $transaction = Transaction::where('transaction_id', $vnp_txn_ref)
                ->where('payment_method', 'vnpay')
                ->where('status', 'pending')
                ->first();

            if (!$transaction) {
                return view('booking.checkout-return')->with('error', 'Transaction not found.');
            }

            if ($request->get('vnp_ResponseCode') == '00') {
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
                        'currency' => 'VND',
                        'startAt' => $transaction->startAt,
                        'endAt' => $transaction->endAt,
                        'bookingType' => $transaction->bookingType,
                        'sessionType' => $transaction->sessionType,
                    ]);

                    // Thêm thông tin transaction
                    $transaction->booking_id = $booking->id;
                    $transaction->startAt = $startAt->toDateTimeString();
                    $transaction->endAt = $endAt->toDateTimeString();
                    $transaction->payment_data = json_encode($request->all());
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
                    return view('booking.checkout-return', data: compact('code'));
                } catch (\Exception $e) {
                    DB::rollBack();
                    dd($e);
                    return view('booking.checkout-return')->with('error', 'Booking failed. Please try again.');
                }

            } else {
                if ($transaction) {
                    $paymentData = json_decode($transaction->payment_data, true);

                    $paymentData['vnp_Amount'] = $request->get('vnp_Amount');
                    $paymentData['vnp_BankCode'] = $request->get('vnp_BankCode');
                    $paymentData['vnp_BankTranNo'] = $request->get('vnp_BankTranNo');
                    $paymentData['vnp_CardType'] = $request->get('vnp_CardType');
                    $paymentData['vnp_OrderInfo'] = $request->get('vnp_OrderInfo');
                    $paymentData['vnp_PayDate'] = $request->get('vnp_PayDate');
                    $paymentData['vnp_ResponseCode'] = $request->get('vnp_ResponseCode');
                    $paymentData['vnp_SecureHash'] = $request->get('vnp_SecureHash');
                    $paymentData['vnp_TmnCode'] = $request->get('vnp_TmnCode');
                    $paymentData['vnp_TransactionNo'] = $request->get('vnp_TransactionNo');
                    $paymentData['vnp_TransactionStatus'] = $request->get('vnp_TransactionStatus');
                    $paymentData['vnp_TxnRef'] = $request->get('vnp_TxnRef');

                    $transaction->payment_data = json_encode($paymentData);
                    $transaction->status = 'failed';
                    $transaction->save();
                    return view('booking.checkout-return', data: compact('code'));
                }
                return view('booking.checkout-return')->with('error', 'Transaction not found.');
            }
        }
        return view('booking.checkout-return', data: compact('code'));
    }
}