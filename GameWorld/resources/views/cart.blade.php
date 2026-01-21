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

        <h1>Your Shopping Cart</h1>
        @if(empty($cartItems))
            <p>Your cart is empty.</p>
        @else
            <div class="games-container">
            @if(empty($cartItems))
                <p>Your cart is empty.</p>
            @else
                <div class="games-grid">
                    @foreach($cartItems as $item)
                        @php $game = $item['game']; @endphp

                        <div class="game-card">
                            <div class="game-image">
                                <img src="{{ asset('storage/' . $game->img) }}.jpg" alt="{{ $game->title }}">
                            </div>

                            <div class="game-info">
                                <h3>{{ $game->title }}</h3>

                                <div class="price-platform">
                                    <p class="game-price">
                                        €{{ number_format($game->price, 2) }}
                                    </p>
                                    <p class="game-platform">
                                        {{ $game->platform->name }}
                                    </p>
                                </div>

                                <p>Quantity: {{ $item['quantity'] }}</p>

                                <a href="/info?game={{ $game->id }}" class="btn-view-details">
                                    View Details
                                </a>
                                
                                <form action="/remove-from-cart" method="POST" class="delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="game_id" value="{{ $game->id }}">
                                    <button type="submit" class="btn-delete">
                                        Remove from Cart
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
        <div class="checkout-section">
            <div class="checkout-container">
                <h2 class="checkout-title">Order Summary</h2>
                
                <div class="checkout-content">
                    <!-- Coupon Section -->
                    <div class="coupon-section">
                        <form action="/cart/apply-coupon" method="POST" class="coupon-form">
                            @csrf
                            <input 
                                type="text" 
                                name="coupon_code" 
                                placeholder="Enter coupon code" 
                                class="coupon-input"
                            >
                            <button type="submit" class="btn-apply-coupon">
                                Apply
                            </button>
                        </form>
                    </div>

                    <!-- Price Breakdown -->
                    <div class="price-breakdown">
                        <div class="price-row">
                            <span>Subtotal:</span>
                            <span>€{{ number_format($subtotal ?? 0, 2) }}</span>
                        </div>
                        
                        @if(isset($discount) && $discount > 0)
                        <div class="price-row discount">
                            <span>Discount:</span>
                            <span>-€{{ number_format($discount, 2) }}</span>
                        </div>
                        @endif
                        
                        <div class="price-row">
                            <span>Tax (21%):</span>
                            <span>€{{ number_format($tax ?? 0, 2) }}</span>
                        </div>
                        
                        <div class="price-divider"></div>
                        
                        <div class="price-row total">
                            <span>Total:</span>
                            <span>€{{ number_format($totalprice ?? 0, 2) }}</span>
                        </div>
                    </div>

                    <!-- Checkout Button -->
                    <form action="/checkout" method="POST">
                        @csrf
                        <button type="submit" class="btn-checkout">
                            Proceed to Checkout
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endif

    @else
        @include('partials.login')
    @endauth
</body>
</html>