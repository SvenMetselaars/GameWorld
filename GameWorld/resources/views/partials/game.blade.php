<div class="games-container">
    @if($games->isEmpty())
        <p>No games found in this category.</p>
    @else
        <div class="games-grid">
            @foreach($games as $game)
                <div class="game-card">
                    <div class="game-image">
                        <img src="{{ asset('storage/' . $game->img) }}.jpg" alt="{{ $game->title }}">
                    </div>
                    <div class="game-info">
                        <h3>{{ $game->title }}</h3>
                        <div class="price-platform">
                            <p class="game-price">€{{ number_format($game->price, 2) }}</p>
                            <p class="game-platform">{{ $game->platform->name }}</p>
                        </div>
                        <a href="/info?game={{ $game->id }}" class="btn-view-details">View Details</a>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>