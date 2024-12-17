<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
</head>
<body>
@if (session('success'))
    <div id="success-message" style="color: green; margin: 10px 0; padding: 10px; border: 1px solid green; background-color: #d4edda; border-radius: 5px;">
        {{ session('success') }}
    </div>

    <script>
        // Tự động ẩn thông báo sau 5 giây
        setTimeout(function () {
            const message = document.getElementById('success-message');
            if (message) {
                message.style.display = 'none';
            }
        }, 5000); // 5000ms = 5 giây
    </script>
@endif
    <h1>Welcome to the Homepage</h1>
    <button onclick="window.location.href = '/login';">Logout</button>
</body>
</html>
