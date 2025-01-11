<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
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

        .login-box {
            max-width: 400px;
            margin: 50px auto;
            background: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .text-center img {
            max-width: 150px;
            margin-bottom: 15px;
        }

        .error-message {
            color: red;
            font-size: 0.875em;
        }

        #lockoutMessage {
            display: none;
            color: red;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container">
        @if (session('success'))
            <div id="success-message" class="alert alert-success text-center" style="margin-top: 20px;">
                {{ session('success') }}
            </div>
            <script>
                setTimeout(function () {
                    const message = document.getElementById('success-message');
                    if (message) {
                        message.style.display = 'none';
                    }
                }, 5000);
            </script>
        @endif

        @if (session('error'))
            <div class="alert alert-danger text-center" style="margin-top: 20px;">
                {{ session('error') }}
            </div>
        @endif

        <div class="login-box">
            <div class="header-box">
                <h2>Login</h2>
            </div>
            <form method="POST" action="{{ route('login.post') }}">
                @csrf
                <div class="mb-3">
                    <label for="emailOrUsername" class="form-label">Username or Email</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-person"></i></span>
                        <input type="text" class="form-control" id="emailOrUsername" name="emailOrUsername" required>
                    </div>
                    @error('emailOrUsername')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-lock"></i></span>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    @error('password')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary w-100">Login</button>

                <div class="mt-2 text-center">
                    <a href="{{ route('google.login') }}" class="btn btn-danger w-100">
                        <i class="bi bi-google"></i> Login with Google
                    </a>
                </div>


                <div class="mt-3 text-center">
                    @if(session('lockout_duration', 0) > 0)
                        <div class="error-message">
                            Too many login attempts. Please wait <span
                                id="lockout-time">{{ session('lockout_duration') }}</span> seconds.
                        </div>
                    @endif
                    <p>Don't have an account? <a href="/register" class="text-primary">Register here</a></p>
                    <p><a href="/forgot-password" class="text-danger">Forgot your password?</a></p>
                    <img src="{{ asset('images/logo.jpg') }}" alt="Logo" class="img-fluid">
                </div>
            </form>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const lockoutTime = document.getElementById("lockout-time");
            if (lockoutTime) {
                let remainingSeconds = parseInt(lockoutTime.textContent);

                function updateCountdown() {
                    if (remainingSeconds > 0) {
                        lockoutTime.textContent = remainingSeconds;
                        remainingSeconds--;
                        setTimeout(updateCountdown, 1000);
                    } else {
                        location.reload(); // Sau khi hết thời gian khóa, reload lại trang
                    }
                }

                updateCountdown();
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>