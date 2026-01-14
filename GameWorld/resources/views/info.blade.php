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

        @foreach($games as $game)
        @if(request()->query('game') == $game->id)
        <div class="topside{{ strtolower($game->platform->name) }}">
            <div class="infopage">
                <div class="productimage">
                    <img src="{{ asset('storage/' . $game->img) }}.jpg" height="350px" alt="{{ $game->title }}">
                </div>
                <div class="productinfopage">
                    <h2>{{ $game->title }}</h2>
                    <div class="priceratingps5">
                        <h2>€{{ number_format($game->price, 2) }}</h2>
                        <h2>{{ $game->rating }}</h2>
                    </div>
                    
                    <p class="fat">category:</p>
                    <p>
                        {{ $game->categories->pluck('name')->join(', ') }}
                    </p>

                    <p class="fat">information:</p>
                    <p class="gameinfo"> {{ $game->info }} </p>
                </div>
                <div>     
                    <video class="infovideo" src="{{ asset('storage/' . $game->img) }}.mp4" controls muted autoplay></video>
                </div>
            </div>
        </div>
        @endif
        @endforeach


    @else
        @include('partials.login')
    @endauth
</body>
</html>