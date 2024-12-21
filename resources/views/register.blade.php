<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }
        .header-box {
            background-color: #e9891c; /* Nền nhạt */
            border: 1px solid #ddd; /* Viền nhẹ */
            border-radius: 8px; /* Góc bo tròn */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Bóng đổ */
            color: #f3efef; /* Màu chữ */
        }
        .header-box h2 {
            margin: 0;
            font-size: 25px;
            font-weight: bold;
        }
        .container {
            max-width: 500px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        h2 {
            font-size: 1.5rem;
            text-align: center;
            margin-bottom: 20px;
        }
        .form-label {
            font-weight: bold;
        }
        input, select, textarea, button {
            font-size: 0.9rem;
            border-radius: 4px;
        }
        .input-group {
            margin-bottom: 15px;
        }
        .input-group-text {
            background-color: #f1f1f1;
            border: 1px solid #ccc;
            border-right: 0;
            border-radius: 4px 0 0 4px;
            padding: 5px 10px;
            font-size: 16px;
        }
        input, select, textarea {
            width: 100%;
            padding: 10px;
            padding-left: 15px;
            border: 1px solid #ccc;
            outline: none;
            font-size: 14px;
            border-radius: 0 4px 4px 0;
        }
        input:focus, select:focus, textarea:focus {
            border-color: #007bff;
        }
        button {
            width: 100%;
            padding: 10px;
            border: none;
            background-color: #007bff;
            color: #fff;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.2s;
        }
        button:hover {
            background-color: #0056b3;
        }
        .error-message {
            font-size: 0.8rem;
            color: red;
            margin-top: 5px;
            display: block;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="header-box mb-4 text-center p-3 rounded">
            <h2>Register</h2>
        </div>
        <form method="POST" action="{{ route('user.store') }}">
            @csrf

            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-person"></i></span>
                    <input type="text" class="form-control" id="username" name="username" value="{{ old('username') }}" required minlength="3" aria-describedby="usernameError">
                </div>
                @error('username')<div id="usernameError" class="error-message">{{ $message }}</div>@enderror
            </div>

            <div class="mb-3">
                <label for="firstName" class="form-label">First Name</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                    <input type="text" class="form-control" id="firstName" name="firstName" value="{{ old('firstName') }}" required aria-describedby="firstNameError">
                </div>
                @error('firstName')<div id="firstNameError" class="error-message">{{ $message }}</div>@enderror
            </div>

            <div class="mb-3">
                <label for="lastName" class="form-label">Last Name</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                    <input type="text" class="form-control" id="lastName" name="lastName" value="{{ old('lastName') }}" required aria-describedby="lastNameError">
                </div>
                @error('lastName')<div id="lastNameError" class="error-message">{{ $message }}</div>@enderror
            </div>

            <div class="mb-3">
                <label for="dayofBirth" class="form-label">Date of Birth</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-calendar-check"></i></span>
                    <input type="date" class="form-control" id="dayofBirth" name="dayofBirth" value="{{ old('dayofBirth') }}" max="{{ \Carbon\Carbon::now()->toDateString() }}" required aria-describedby="dayofBirthError">
                </div>
                @error('dayofBirth')<div id="dayofBirthError" class="error-message">{{ $message }}</div>@enderror
            </div>

            <div class="mb-3">
                <label for="gender" class="form-label">Gender</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-gender-ambiguous"></i></span>
                    <select class="form-control" id="gender" name="gender" required aria-describedby="genderError">
                        <option value="" disabled selected>Select Gender</option>
                        <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                        <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                    </select>
                </div>
                @error('gender')<div id="genderError" class="error-message">{{ $message }}</div>@enderror
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required aria-describedby="emailError">
                </div>
                @error('email')<div id="emailError" class="error-message">{{ $message }}</div>@enderror
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">Phone Number</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-phone"></i></span>
                    <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone') }}" required aria-describedby="phoneError">
                </div>
                @error('phone')<div id="phoneError" class="error-message">{{ $message }}</div>@enderror
            </div>

            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-house-door"></i></span>
                    <input type="text" class="form-control" id="address" name="address" value="{{ old('address') }}" required aria-describedby="addressError">
                </div>
                @error('address')<div id="addressError" class="error-message">{{ $message }}</div>@enderror
            </div>

            <div class="mb-3">
                <label for="country" class="form-label">Country</label>
                <select class="form-control select2" id="country" name="country" required aria-describedby="countryError">
                    <option value="USA">USA</option>
                    <option value="Canada">Canada</option>
                </select>
                @error('country')<div id="countryError" class="error-message">{{ $message }}</div>@enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-lock"></i></span>
                    <input type="password" class="form-control" id="password" name="password" required aria-describedby="passwordError">
                </div>
                @error('password')<div id="passwordError" class="error-message">{{ $message }}</div>@enderror
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required aria-describedby="confirmPasswordError">
                </div>
                @error('password_confirmation')<div id="confirmPasswordError" class="error-message">{{ $message }}</div>@enderror
            </div>

            <button type="submit" class="btn btn-primary">Register</button>
            <div class="mt-3">
                <p class="text-center">Already have an account? <a href="/login" class="text-primary">Click here to log in</a></p>
                <div class="text-center">
                    <img src="{{asset('images/logo.jpg')}}" alt="Logo" class="img-fluid" style="max-width: 200px;">
                </div>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
    $('#country').select2({
        placeholder: "Select a country",
        allowClear: true,
        width: '100%'
    });
    $.ajax({
        url: 'https://restcountries.com/v3.1/all',
        method: 'GET',
        success: function(data) {
            $('#country').empty();
            $('#country').append('<option value="" disabled selected>Select a country</option>');

            // Sắp xếp dữ liệu theo thứ tự bảng chữ cái
            data.sort(function(a, b) {
                return a.name.common.localeCompare(b.name.common);
            });

            // Thêm các quốc gia vào danh sách
            data.forEach(function(country) {
                $('#country').append(`<option value="${country.name.common}">${country.name.common}</option>`);
            });
        },
        error: function(err) {
            console.error('Error fetching country data:', err);
        }
    });
});
        document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("form");
    const inputs = form.querySelectorAll("input, select, textarea");

    // Kiểm tra từng trường ngay khi người dùng nhập hoặc rời khỏi trường
    inputs.forEach((input) => {
        input.addEventListener("input", () => validateField(input));
        input.addEventListener("blur", () => validateField(input));
    });

    // Hàm kiểm tra và hiển thị lỗi
    function validateField(input) {
        let errorMessage = input.parentElement.querySelector(".error-message");

        if (!errorMessage) {
            // Tạo phần tử hiển thị lỗi nếu chưa có
            errorMessage = document.createElement("span");
            errorMessage.className = "error-message text-danger d-block w-100";
            input.parentElement.appendChild(errorMessage);
        }

        // Kiểm tra và hiển thị lỗi phù hợp
        if (input.validity.valid) {
            errorMessage.textContent = ""; // Xóa lỗi nếu dữ liệu hợp lệ
        } else {
            if (input.validity.valueMissing) {
                errorMessage.textContent = "This field is required.";
            } else if (input.validity.typeMismatch) {
                // Kiểm tra cho các trường email
                if (input.type === "email") {
                    errorMessage.textContent = "Please enter a valid email.";
                }
            } else if (input.validity.tooShort) {
                errorMessage.textContent = `Please lengthen this to at least ${input.minLength} characters.`;
            } else if (input.validity.patternMismatch) {
                errorMessage.textContent = "Invalid format.";
            }
            // Kiểm tra mật khẩu và xác nhận mật khẩu
            if (input.id === 'password' || input.id === 'password_confirmation') {
                let passwordField = document.querySelector("#password");
                let confirmPasswordField = document.querySelector("#password_confirmation");
                if (confirmPasswordField && passwordField && confirmPasswordField.value !== passwordField.value) {
                    confirmPasswordField.setCustomValidity("Passwords do not match.");
                    errorMessage.textContent = "Passwords do not match.";
                } else {
                    confirmPasswordField.setCustomValidity(""); // Reset lỗi
                }
            }
        }
    }
});
    </script>
</body>
</html>
