<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Carbon\Carbon;
use Hash;
use Illuminate\Http\Request;
use App\Services\GoogleClientService;
use Google\Service\Calendar\Event;
use Log;
use Session;
use Str;

class GoogleCalendarController extends Controller
{
    protected $googleClientService;

    public function __construct(GoogleClientService $googleClientService)
    {
        $this->googleClientService = $googleClientService;
    }

    public function redirectToGoogle()
    {
        $authUrl = $this->googleClientService->getAuthUrl();
        return redirect($authUrl);
    }

    public function handleGoogleCallback(Request $request)
    {
        try {
            $code = $request->input('code');

            if (!$code) {
                return redirect()->route('login')->with('error', 'Authorization failed');
            }

            $token = $this->googleClientService->fetchAccessTokenWithAuthCode($code);
            $googleUser = $this->googleClientService->getUserInfo($token['access_token']);

            $username = $this->generateUniqueUsername($googleUser->name);

            $user = User::firstOrCreate(
                ['email' => $googleUser->email],
                [
                    'username' => $username,
                    'firstName' => $googleUser->givenName ?? null,
                    'lastName' => $googleUser->familyName ?? null,
                    'password' => Hash::make(Str::random(20)),
                    'dayofBirth' => now(),
                    'gender' => 'male', // Nếu không có thông tin gender từ Google
                    'phone' => null,    // Google không trả về phone
                    'address' => null,  // Google không trả về address
                    'country' => 'Việt Nam',
                    'email_verified_at' => now(),
                    'role' => 'user',
                    'status' => 'active',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );

            session(['google_access_token' => $token]);

            $user->google_refresh_token = $token['refresh_token'];

            Auth::login($user);

            // Điều hướng sau khi đăng nhập
            return $this->handleRedirect($user);
        } catch (\Exception $e) {
            Log::error('Google login error: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
            return redirect('/login')->with('error', 'Login with Google failed. Please try again.');
        }
    }

    private function generateUniqueUsername(string $rawName): string
    {
        $baseUsername = str_replace('-', '_', Str::slug($rawName));
        $username = $baseUsername;
        $counter = 1;

        while (User::where('username', $username)->exists()) {
            $username = "{$baseUsername}_{$counter}";
            $counter++;
        }

        return $username;
    }

    private function handleRedirect(User $user)
    {
        $redirect_to = Session::get('redirect_to');
        $booking_params = Session::get('booking_params');

        if ($redirect_to && $booking_params) {
            Session::forget(['redirect_to', 'booking_params']);
            $query = http_build_query($booking_params);
            return redirect("{$redirect_to}?{$query}");
        }

        $url = match ($user->role) {
            'admin', 'staff' => route('admin.dashboard'),
            'owner' => route('owner.dashboard'),
            'user' => route('homepage'),
            default => route('homepage'),
        };

        return redirect()->intended($url)->with('success', 'You have successfully logged in.');
    }

    public function createCalendarEvent($transaction, $room, $building, $booking)
    {

        try {
            // Lấy token từ session
            $token = Session::get('google_access_token');

            if (!$token) {
                return redirect()->route('google.login')->with('error', 'Please connect your Google account first.');
            }

            // Thiết lập token
            $this->googleClientService->setAccessToken($token);

            // Chuyển đổi startAt và endAt sang định dạng ISO 8601
            $startAt = Carbon::parse($transaction->startAt)->toIso8601String();
            $endAt = Carbon::parse($transaction->endAt)->toIso8601String();

            // Tạo sự kiện Google Calendar
            $event = new Event([
                'summary' => 'You have an event at: ' . $building->name,
                'location' => $building->address, // Cần thêm địa chỉ phòng nếu có
                'description' => 'Event details: ' . PHP_EOL .
                    'Address: ' . $building->address . PHP_EOL .
                    'Room name: ' . $room->name,
                'start' => [
                    'dateTime' => $startAt,
                    'timeZone' => 'Asia/Ho_Chi_Minh',
                ],
                'end' => [
                    'dateTime' => $endAt,
                    'timeZone' => 'Asia/Ho_Chi_Minh',
                ],
            ]);

            $calendarService = $this->googleClientService->getCalendarService();
            $calendarId = 'primary'; // Sử dụng lịch chính
            $createdEvent = $calendarService->events->insert($calendarId, $event);

            return response()->json([
                'status' => 'success',
                'event_link' => $createdEvent->htmlLink,
            ]);
        } catch (\Google\Service\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], $e->getCode());
        }
    }
}
