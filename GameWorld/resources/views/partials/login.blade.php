<div class="register_page">
    <div class="register">
        <div class="r_banner">
            <img src="{{ asset('storage/background_pic.jpg') }}" alt="Background">
            <h2>Login here!</h2>
        </div>
        
        <form action="/login" method="POST" autocomplete="off">
            @csrf
            <h1>Login</h1>
            <input type="email"     placeholder="E-Mail"    name="loginEmail"       />
            <input type="password"  placeholder="Password"  name="loginpassword"    />
            <input type="submit"    value="Sign in"         name="loginButton"      />
            <h2>dont have an acount yet? <a href="/register">register Here!</a></h2>
        </form>
    </div>
</div>