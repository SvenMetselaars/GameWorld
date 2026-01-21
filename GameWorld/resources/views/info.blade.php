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

        @include('partials.navbar', ['console' => 'navbar' . strtolower($game->platform->name)])

        
        <div class="topside{{ strtolower($game->platform->name) }}">
            @if (!auth()->user()->is_admin)
            <div class="infopage">
                <div class="productimage">
                    <img src="{{ asset('storage/' . $game->img) }}.jpg" height="350px" alt="{{ $game->title }}">
                </div>
                <div class="productinfopage">
                    <h2>{{ $game->title }}</h2>
                    <div class="pricerating{{ strtolower($game->platform->name) }}">
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
            </div>
            @endif

            @if (auth()->user()->is_admin)
            <form class="infopage" action="/edit-game/{{ $game->id }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="productimage">
                    <img src="{{ asset('storage/' . $game->img) }}.jpg" height="350px" alt="{{ $game->title }}" id="preview-image">
                </div>
                
                <div class="productinfopage">
                    <label for="title">Title:</label>
                    <input type="text" name="title" id="title" value="{{ old('title', $game->title) }}" required>
                    
                    <div class="pricerating{{ strtolower($game->platform->name) }}">
                        <div>
                            <label for="price">Price (€):</label>
                            <input type="number" name="price" id="price" step="0.01" min="0" value="{{ old('price', $game->price) }}" required>
                        </div>
                        
                        <div>
                            <label for="rating">Rating:</label>
                            <input type="number" name="rating" id="rating" step="0.1" min="0" max="10" value="{{ old('rating', $game->rating) }}" required>
                        </div>
                    </div>
                    
                    <label for="platform">Platform:</label>
                    <select name="platform_id" id="platform" required>
                        @foreach($platforms as $platform)
                            <option value="{{ $platform->id }}" {{ $game->platform_id == $platform->id ? 'selected' : '' }}>
                                {{ $platform->name }}
                            </option>
                        @endforeach
                    </select>
                    
                    <p class="fat">Categories:</p>
                    <div class="categories-checkboxes">
                        @foreach($categories as $category)
                            <label>
                                <input type="checkbox" name="categories[]" value="{{ $category->id }}"
                                    {{ $game->categories->contains($category->id) ? 'checked' : '' }}>
                                {{ $category->name }}
                            </label>
                        @endforeach
                    </div>
                    
                    <label for="info" class="fat">Information:</label>
                    <textarea name="info" id="info" rows="6" required>{{ old('info', $game->info) }}</textarea>
                    
                    <div class="form-actions">
                        <button type="submit" class="btn-save">Save Changes</button>
                        <a href="/game/{{ $game->id }}" class="btn-cancel">Cancel</a>
                    </div>
                </div>
            </form>
            @endif

            <div>     
                <video class="infovideo" src="{{ asset('storage/' . $game->img) }}.mp4" controls muted autoplay></video>
            </div>
            <div class="shoppingpart{{ strtolower($game->platform->name) }}">
                <form action="/add-to-wishlist" method="POST">
                    @csrf
                    <input type="hidden" name="game_id" value="{{ $game->id }}">
                    <button type="submit">add to wishlist</button>
                </form>
                <h2>€{{ number_format($game->price, 2) }}</h2>
                <p>orderd before 8:00pm next day at your door</p>
                <p>add to shopping cart NOW</p>
                <form action="/add-to-cart" method="POST">
                    @csrf
                    <input type="hidden" name="game_id" value="{{ $game->id }}">
                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                    <input type="number" name="quantity" value="1" min="1" style="width: 50px; margin-right: 10px;">
                    <button type="submit">add to cart</button>
                </form>
            </div>
        </div>


        @include('partials.game', ['games' => $relatedGames])

    @else
        @include('partials.login')
    @endauth
</body>
</html>