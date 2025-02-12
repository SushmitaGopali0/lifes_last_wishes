<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="{{asset('css/login.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="login-container">
        <div class="login-box">
            <div class="login-header">
                <h2 class="login-title">Please Login</h2>
                <p class="login-subtitle"><a href="#">or Create An Account</a></p>
            </div>
            <form>
                <div class="input-group">
                    <div class="input-icon">@</div>
                    <input type="email" class="input-field" placeholder="you@example.com" required>
                </div>
                <div class="input-group">
                    <div class="input-icon">🔑</div>
                    <input type="password" class="input-field" placeholder="Password" required>
                </div>
                <div class="options">
                    <label class="remember-me"><input type="checkbox"> Remember</label>
                    <a href="#" class="forgot-password">Forgot Your Password?</a>
                </div>
                <button type="submit" class="login-btn">Login</button>
            </form>
        </div>
    </div>
</body>
</html>