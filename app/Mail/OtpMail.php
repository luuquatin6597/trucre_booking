<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OtpMail extends Mailable
{
    use Queueable, SerializesModels;

    public $otp;

    /**
     * Tạo instance mới của thông điệp
     *
     * @param string $otp
     */
    public function __construct($otp)
    {
        $this->otp = $otp; // Gán mã OTP
    }

    /**
     * Xây dựng thông điệp
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('OTP Verification Code') // Tiêu đề email
                    ->from('contact.trucre@gmail.com')  // Địa chỉ email người gửi
                    ->view('otp-email') // Sử dụng view otp-form để hiển thị email
                    ->with([
                        'otp' => $this->otp, // Truyền mã OTP vào nội dung email
                    ]);
    }
}
