<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/style.css" rel="stylesheet">
    <title>Netflix Clone - Register</title>
</head>

<body>
    @auth
        <!-- If user is already logged in, redirect or show message -->
        <div class="auth-wrapper">
            <div class="auth-container">
                <p class="logged-in">You are already logged in!</p>
                <a href="/" class="btn btn-play" style="text-align: center;">Go to Home</a>
            </div>
        </div>
    @else
        <!-- Register Form -->
        <div class="register_page">
        <div class="register">
            <div class="r_banner">
                <img src="{{ asset('storage/background_pic.jpg') }}" alt="Background">
                <h2>Register Here!</h2>
            </div>
                <form action="/register" method="POST" autocomplete="off">
                    @csrf
                    <h1>Register</h1>

                    <div class="formHalf">
                        <input type="text" name="firstName" placeholder="First Name" required />
                        <input type="text" name="lastName"  placeholder="Surname" required />
                    </div>

                    <input type="email" name="email" placeholder="E-Mail" required />

                    <div class="formHalf">
                        <input type="password" name="password" placeholder="Password" required />
                        <input type="password" name="password_confirmation" placeholder="Confirm Password" required />
                    </div>

                    <input type="submit" value="Sign Up" />

                    <h2>Already have an account? <a href="/">Log in here!</a></h2>
                </form>
            </div>
        </div>
    @endauth
</body>
</html>