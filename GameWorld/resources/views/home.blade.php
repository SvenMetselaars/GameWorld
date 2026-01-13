<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/style.css" rel="stylesheet">
    <title>GameWorld</title>
</head>

<body>
    @auth

        <div class='navbar'>  
            <header>
                <div class="Logo">
                    <a href='/'><img src="{{ asset('storage/GameWorld.png') }}" alt='Background' height='40px'></a>
                </div>
            </header>
            <nav>
                <div class="navbuttons">
                    <a href="/"  class='navbarbuttons' style="margin-left: 20px;">home</a>
                    <a href="/wishlist"  class='navbarbuttons'>wishlist</a>
                    <a href="/shopingcart"  class='navbarbuttons'>shoping cart</a>
                    <a href="/contact"  class='navbarbuttons'>contact</a>
                    <a href="/profile" method="POST" class='navbarbuttons'>profile</a>                    
                </div>    
            </nav>
        </div>

    <div class="bannerall">
        <img src="{{ asset('storage/bannerall.jpg') }}" class="banner"/>
    </div>

    <div class="banners_div">
        <a href="/platform?platform=1"><img src="{{ asset('storage/switch.jpg') }}" class="banners bannerswitch"/></a>
        <a href="/platform?platform=2"><img src="{{ asset('storage/ps5.jpg') }}" class="banners bannerps5"/></a>
        <a href="/platform?platform=3"><img src="{{ asset('storage/xbox.jpg') }}" class="banners bannerxbox"/></a>
    </div>
    <div class="category-container">

        
        <button id="prevBtn">‹</button>

        <a href="{{ route('home', ['category' => 'index']) }}"
        class="{{ $activeCategory == 'index' ? 'pickedbutton' : 'navbarbuttons' }} category-btn" data-index="0">
        no filter
        </a>
        @foreach($categories as $index => $category)
            <a href="?category={{ $category->id }}"
            class="{{ $activeCategory == $category->id ? 'pickedbutton' : 'navbarbuttons' }} category-btn"
            data-index="{{ $index+1}}">
                {{ $category->name }}
            </a>
        @endforeach

        <button id="nextBtn">›</button>
    </div>

    <div class="games-container">
        @if($games->isEmpty())
            <p>No games found in this category.</p>
        @else
            <div class="games-grid">
                @foreach($games as $game)
                    <div class="game-card">
                        <div class="game-image">
                            <img src="{{ asset('storage/' . $game->img) }}" alt="{{ $game->title }}">
                        </div>
                        <div class="game-info">
                            <h3>{{ $game->title }}</h3>
                            <p class="game-price">€{{ number_format($game->price, 2) }}</p>
                            <a href="/" class="btn-view-details">View Details</a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    @else
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
                <input type="submit"    value="Sign Up"         name="loginButton"      />
                <h2>dont have an acount yet? <a href="login.php?page=register">register Here!</a></h2>
            </form>
        </div>
    </div>
    @endauth

    <script src="js/app.js"></script>
</body>
</html>