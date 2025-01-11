<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use App\Mail\OtpMail;

class UserController extends Controller
{
    public function showForm()
    {

        return view('register');
    }
    public function store(Request $request)
{
    // Xác thực dữ liệu từ form
    $validatedData = $request->validate([
        'username' => 'required|string|unique:users,username',
        'firstName' => 'required|string',
        'lastName' => 'required|string',
        'dayofBirth' => 'required|date',
        'gender' => 'required|in:male,female,other',
        'password' => 'required|string|min:6|confirmed',
        'email' => [
            'required',
            'email',
            'unique:users,email',
            function ($attribute, $value, $fail) {
                if (!str_ends_with($value, '@gmail.com')) {
                    $fail('Email must belong to the @gmail.com domain.');
                }
            }
        ],
        'phone' => [
            'required',
            'regex:/^\d{10,11}$/', // Chỉ chấp nhận số điện thoại 10 hoặc 11 số
            'unique:users,phone'
        ],
        'address' => 'nullable|string',
        'country' => 'nullable|string',
        'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Kiểm tra ảnh
    ]);

    $birthDate = new \DateTime($validatedData['dayofBirth']);
    $currentDate = new \DateTime();
    $age = $currentDate->diff($birthDate)->y;

    if ($age < 16) {
        return redirect()->back()->withErrors(['dayofBirth' => 'You must be at least 16 years old to register.']);
    }

    // Xử lý file ảnh (nếu có)
    $photoPath = null;
    if ($request->hasFile('photo')) {
        $photoPath = $request->file('photo')->store('profile_photos', 'public');
    }

    User::create([
        'username' => $validatedData['username'],
        'firstName' => $validatedData['firstName'],
        'lastName' => $validatedData['lastName'],
        'dayofBirth' => $validatedData['dayofBirth'],
        'gender' => $validatedData['gender'],
        'password' => Hash::make($validatedData['password']), // Mã hóa mật khẩu
        'email' => $validatedData['email'],
        'phone' => $validatedData['phone'],
        'address' => $validatedData['address'],
        'country' => $validatedData['country'],
        'role' => 'user', // Giả sử mặc định là user
        'status' => 'active', // Giả sử mặc định là active
        'photo' => $photoPath, // Lưu đường dẫn ảnh (nếu có)
        'remember_token' => $request->remember_token ?? null, // Lưu remember_token nếu có
        'email_verified_at' => null, // Mặc định chưa xác nhận email
        'point' => 0, // Điểm mặc định
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    return redirect()->route('login')->with('success', 'Registration successful! Please log in.');
}
public function showLoginForm()
{
    return view('login'); // Hiển thị trang đăng nhập
}

public function login(Request $request)
{
    $credentials = $request->validate([
        'emailOrUsername' => 'required',
        'password' => 'required',
    ]);

    $field = filter_var($credentials['emailOrUsername'], FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

    // Kiểm tra thời gian khóa tài khoản
    $lockoutTime = session()->get('lockout_time');
    if ($lockoutTime && now()->lessThan($lockoutTime)) {
        $remainingLockoutTime = now()->diffInSeconds($lockoutTime);

        return back()->with([
            'lockout_duration' => $remainingLockoutTime
        ]);
    }

    // Nếu hết thời gian khóa, reset số lần thất bại
    if ($lockoutTime && now()->greaterThanOrEqualTo($lockoutTime)) {
        session()->forget('lockout_time');
    }

    // Lấy số lần thất bại hiện tại
    $failedAttempts = session()->get('failed_attempts', 0);

    // Xác thực email/username
    $user = \App\Models\User::where($field, $credentials['emailOrUsername'])->first();
    if (!$user) {
        $failedAttempts += 1;
        session()->put('failed_attempts', $failedAttempts); // Lưu lại số lần thất bại

        // Tính toán thời gian khóa theo số lần thất bại
        if ($failedAttempts >= 5) {
            $lockoutDuration = pow(2, $failedAttempts - 5) * 60; // 1 phút, 5 phút, 10 phút...
            session()->put('lockout_time', now()->addSeconds($lockoutDuration));

            // Chỉ sử dụng `with()` để truyền thông tin lockout
            return back()->with([
                'lockout_duration' => $lockoutDuration,
                'error_message' => "Too many login attempts. Please wait for " . ($lockoutDuration / 60) . " minutes.",
            ]);
        }

        // Thông báo lỗi cụ thể
        return back()->withErrors([
            'emailOrUsername' => 'No account associated with this email or username.',
        ]);
    }

    // Xác thực mật khẩu
    if (!$user || !Hash::check($credentials['password'], $user->password)) {
        $failedAttempts += 1;
        session()->put('failed_attempts', $failedAttempts); // Lưu lại số lần thất bại

        // Tính toán thời gian khóa theo số lần thất bại
        if ($failedAttempts >= 5) {
            $lockoutDuration = pow(2, $failedAttempts - 5) * 60; // 1 phút, 5 phút, 10 phút...
            session()->put('lockout_time', now()->addSeconds($lockoutDuration));

            // Chỉ sử dụng `with()` để truyền thông tin lockout
            return back()->with([
                'lockout_duration' => $lockoutDuration,
                'error_message' => "Too many login attempts. Please wait for " . ($lockoutDuration / 60) . " minutes.",
            ]);
        }

        return back()->withErrors([
            'password' => 'Incorrect password.',
        ]);
    }

    $request->session()->regenerate();
    session()->forget(['failed_attempts', 'lockout_time']);
    return redirect()->intended(route('homepage'))->with('success', 'You have successfully logged in.');
}

public function logout(Request $request)
{
    Auth::logout(); // Đăng xuất người dùng

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/login');
}

public function showForgotPasswordForm()
{
    return view('forget-password');
}

public function submitForgotPasswordForm(Request $request)
{
    $request->validate([
        'email' => 'required|email|exists:users,email',
    ]);

    $otp = random_int(100000, 999999);

    Session::put('otp', $otp);
    Session::put('otp_time', time());
    Session::put('email', $request->email);

    Mail::to($request->email)->send(new OtpMail($otp));

    return redirect()->route('verify.otp.form')->with('otp_sent', 'OTP code has been sent to your email. Please check your inbox.');
}

public function showOtpForm()
{
    $otpTime = Session::get('otp_time', 0); // Lấy thời gian OTP hoặc mặc định là 0
    $timeLeft = max(60 - (time() - $otpTime), 0); // Tính thời gian còn lại
    return view('otp-form', compact('timeLeft')); // Truyền biến $timeLeft vào view
}

public function verifyOtp(Request $request)
{
    $request->validate(['otp' => 'required|numeric']);

    $otp = Session::get('otp');
    $otpTime = Session::get('otp_time');
    $attempts = Session::get('otp_attempts', 0);
    $lockTime = Session::get('lock_until', 0); // Thời gian khóa tài khoản
    $currentTime = time();

    // Kiểm tra nếu tài khoản đang bị khóa
    if ($currentTime < $lockTime) {
        $timeLeft = $lockTime - $currentTime;
        return redirect()->route('verify.otp.form')->with('otp_locked', "Your account is locked. Please try again in $timeLeft seconds.");
    }

    // Kiểm tra thời gian hết hạn OTP
    if (($currentTime - $otpTime) > 60) {
        Session::forget(['otp', 'otp_time', 'otp_attempts', 'lock_until']);
        return redirect()->route('verify.otp.form')->with('otp_expired', 'OTP has expired. Please request a new one.');
    }

    // Kiểm tra OTP có đúng không
    if ($otp == $request->otp) {
        Session::forget(['otp', 'otp_time', 'otp_attempts', 'lock_until']);
        return redirect()->route('reset.password')->with('success', 'OTP verified! Please reset your password.');
    }

    // Tăng số lần nhập sai OTP
    $attempts += 1;
    Session::put('otp_attempts', $attempts);

    // Kiểm tra nếu vượt quá số lần thử
    if ($attempts >= 3) {
        $lockUntil = $currentTime + 60; // Khóa trong 60 giây
        Session::put('lock_until', $lockUntil);

        return redirect()->route('verify.otp.form')->with('otp_locked', "You have exceeded the maximum number of attempts. Your account is locked for 60 seconds.");
    }

    return redirect()->route('verify.otp.form')->with('otp_invalid', 'Invalid OTP. Please check your email or wait 60 seconds to press Resend OTP if you do not receive the code.');
}

public function resendOtp()
{
    $email = Session::get('email');
    $lockTime = Session::get('lock_until', 0); // Thời gian khóa tài khoản
    $currentTime = time();

    // Kiểm tra nếu tài khoản đang bị khóa
    if ($currentTime < $lockTime) {
        $timeLeft = $lockTime - $currentTime;
        return redirect()->route('verify.otp.form')->with('otp_locked', "Your account is locked. Please try again in $timeLeft seconds.");
    }

    if (!$email) {
        return redirect()->route('forget.password.form')->withErrors(['email' => 'Email session is missing. Please try again.']);
    }

    $otp = random_int(100000, 999999);
    Session::put('otp', $otp);
    Session::put('otp_time', time());
    Session::put('otp_attempts', 0); // Reset số lần thử khi gửi lại mã OTP

    Mail::to($email)->send(new OtpMail($otp));

    return redirect()->route('verify.otp.form')->with('otp_sent', 'OTP code has been resent to your email. Please check your inbox.');
}

    public function showResetPasswordForm()
    {
        return view('reset-password');
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:6|confirmed',
        ]);

        // Lấy người dùng từ session email
        $user = User::where('email', Session::get('email'))->first();

        if ($user) {
            // Cập nhật mật khẩu
            $user->password = Hash::make($request->password);
            $user->save();

            // Xóa OTP khỏi session
            Session::forget('otp');
            Session::forget('email');

            return redirect()->route('login')->with('success', 'Your password has been reset.');
        }

        return back()->withErrors(['email' => 'No user found with this email.']);
    }
}
