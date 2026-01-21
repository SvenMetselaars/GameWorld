<div class="navbar {{ $console ?? '' }}">
    <header>
        <div class="Logo">
            <a href='/'><img src="{{ asset('storage/GameWorld.png') }}" alt='Background' height='40px'></a>
        </div>
    </header>
    <nav>
        <div class="navbuttons">
            <a href="/"  class='navbarbuttons' style="margin-left: 20px;">home</a>
            <a href="/wishlist"  class='navbarbuttons'>wishlist</a>
            <a href="/cart"  class='navbarbuttons'>shoping cart</a>
            <a href="/profile" method="POST" class='navbarbuttons'>profile</a>                    
        </div>    
    </nav>
</div>