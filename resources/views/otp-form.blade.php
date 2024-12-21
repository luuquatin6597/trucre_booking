<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify OTP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .otp-box {
            max-width: 400px;
            margin: 50px auto;
            background: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .header-box {
            background-color: #e9891c;
            color: #fff;
            padding: 15px;
            border-radius: 8px;
            text-align: center;
            margin-bottom: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .header-box h2 {
            margin: 0;
            font-size: 25px;
            font-weight: bold;
        }
        .alert {
            margin-bottom: 20px;
        }
        .resend-hidden {
            display: none;
        }
        .countdown {
            font-weight: bold;
            color: #333;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="otp-box">
            <div class="header-box">
                <h2><i class="bi bi-shield-lock"></i> OTP Verification</h2>
            </div>

            <!-- Hiển thị thông báo thành công hoặc lỗi từ controller -->
            @if (session('otp_sent'))
                <div class="alert alert-success text-center">
                    {{ session('otp_sent') }}
                </div>
            @endif
            @if (session('otp_expired'))
                <div class="alert alert-danger text-center">
                    {{ session('otp_expired') }}
                </div>
            @endif
            @if (session('otp_invalid'))
                <div class="alert alert-danger text-center">
                    {{ session('otp_invalid') }}
                </div>
            @endif
            @if(session('otp_locked'))
                <div class="alert alert-danger">
                    {{ session('otp_locked') }}
                </div>
            @endif

            <form method="POST" action="{{ route('verify.otp') }}">
                @csrf
                <div class="mb-3">
                    <label for="otp" class="form-label">
                        <i class="bi bi-key"></i> Enter OTP Code
                    </label>
                    <input type="text" class="form-control" id="otp" name="otp" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">
                    <i class="bi bi-check-circle"></i> Verify OTP
                </button>
            </form>

            <!-- Countdown Timer -->
            <div class="mt-3 text-center">
                <p class="countdown">
                    You can resend OTP in <span id="countdown-timer">{{ $timeLeft }}</span> seconds.
                </p>
            </div>

            <!-- Resend Button -->
            <div id="resend-otp-btn" class="mt-3 text-center resend-hidden">
                <a href="{{ route('resend.otp') }}" class="btn btn-warning">
                    <i class="bi bi-arrow-clockwise"></i> Resend OTP
                </a>
            </div>

            <div class="mt-3 text-center">
                <img src="{{ asset('images/logo.jpg') }}" alt="Logo" class="img-fluid" style="max-width: 150px;">
            </div>
        </div>
    </div>

    <!-- JavaScript Countdown -->
    <script>
        let timeLeft = {{ $timeLeft }};
        const timerElement = document.getElementById('countdown-timer');
        const resendButton = document.getElementById('resend-otp-btn');
        const countdownText = document.querySelector('.countdown');

        // Countdown Timer Logic
        const timer = setInterval(() => {
            if (timeLeft > 0) {
                timeLeft--;
                timerElement.textContent = timeLeft;
            } else {
                clearInterval(timer);
                resendButton.classList.remove('resend-hidden');
                countdownText.style.display = 'none';
            }
        }, 1000);
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
