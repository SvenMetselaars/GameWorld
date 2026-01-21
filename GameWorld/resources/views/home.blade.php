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

        @include('partials.navbar')

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

        @include('partials.game', ['games' => $games])

                            <form action="/logout" method="POST">
                        @csrf
                        <button type="submit">Log out</button>
                    </form>

    @else
        @include('partials.login')
    @endauth

    <script src="js/app.js"></script>
</body>
</html>