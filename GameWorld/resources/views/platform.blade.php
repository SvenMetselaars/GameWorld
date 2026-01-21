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

        @include('partials.navbar', ['console' => 'navbar' . $activePlatform])

        <div class="bannerall">
            <img src="{{ asset('storage/bannerall.jpg') }}" class="banner"/>
        </div>

        @include('partials.game', ['games' => $games])

    @else
        @include('partials.login')
    @endauth
</body>
</html>