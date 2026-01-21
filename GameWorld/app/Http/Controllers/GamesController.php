<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Platform;
use App\Models\Category;
use App\Models\Game;



class GamesController extends Controller
{
    public function GetCategories(Request $request)
    {
        $categories = Category::all();
        $activeCategory = $request->get('category', 'index');

        $games = Game::when($activeCategory && $activeCategory != 'index', function ($query) use ($activeCategory) {
            $query->whereHas('categories', function ($q) use ($activeCategory) {
                $q->where('categories.id', $activeCategory);
            });
        })
        
        ->inRandomOrder()
        ->limit(5)
        ->get();

        return view('home', compact('categories', 'activeCategory', 'games'));
    }

    public function getPlatforms(Request $request)
    {
        $platforms = Platform::all();
        $activePlatform = $request->get('platform', 'index');

        $games = Game::when($activePlatform && $activePlatform !== 'index', function ($query) use ($activePlatform) {
            $query->where('platform_id', $activePlatform);
        })->get();

        return view('platform', compact('platforms', 'activePlatform', 'games'));
    }

    public function getInfo(Request $request)
    {
        $gameId = $request->get('game');
        $platforms = Platform::all();
        $categories = Category::all();

        $game = Game::with(['categories', 'platform'])
            ->findOrFail($gameId);

        $relatedGames = Game::whereHas('categories', function ($query) use ($game) {
                $query->whereIn(
                    'categories.id',
                    $game->categories->pluck('id')
                );
            })
            ->where('id', '!=', $game->id)
            ->take(5)
            ->get();

        return view('info', compact('game', 'relatedGames', 'platforms', 'categories'));
    }

    public function updateGame(Game $game, Request $request)
    { 
        // check if this info has been recieved
        $incomingFields = $request->validate([
            'title' => 'required',
            'price' => 'required',
            'rating' => 'required',
            'platform_id' => 'required',
            'info' => 'required',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id'
        ]);

        // only check these for tags. (ones that writes code)
        $stringFields = ['title','price','rating','platform_id','info'];
        foreach ($stringFields as $field) {
            $incomingFields[$field] = strip_tags($incomingFields[$field]);
        }

        // update
        $game->update($incomingFields);

        // Sync categories — replaces old ones with new selection
        $game->categories()->sync($request->categories);

        // go to this page
        return redirect('/');
    }

    function addToCart(Request $request)
    {
        $incomingFields = $request->validate([
            'game_id' => 'required|exists:games,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $cart = session()->get('cart', []);

        $gameId = $incomingFields['game_id'];
        $quantity = $incomingFields['quantity'];

        if (isset($cart[$gameId])) {
            $cart[$gameId] += $quantity;
        } else {
            $cart[$gameId] = $quantity;
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Game added to cart!');
    }

    function getCart(Request $request)
    {
        $cart = session()->get('cart', []);
        $cartItems = [];
        $totalprice = 0;


        foreach ($cart as $gameId => $quantity) {
            $game = Game::find($gameId);
            if ($game) {
                $cartItems[] = [
                    'game' => $game,
                    'quantity' => $quantity,
                ];
            }
            $totalprice += $game->price * $quantity;
        }

        $subtotal = $totalprice / 100 * 79;
        $tax = $totalprice - $subtotal;

        return view('cart', compact('cartItems', 'totalprice', 'subtotal', 'tax'));
    }

    function removeFromCart(Request $request)
    {
        $incomingFields = $request->validate([
            'game_id' => 'required|exists:games,id',
        ]);

        $cart = session()->get('cart', []);
        $gameId = $incomingFields['game_id'];

        if (isset($cart[$gameId])) {
            unset($cart[$gameId]);
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Game removed from cart!');
    }

    function checkout(Request $request)
    {
        $cart = session()->get('cart', []);
        $user = $request->user();

        foreach ($cart as $gameId => $quantity) {
            $user->purchasedGames()->attach($gameId, ['amount' => $quantity]);
        }

        session()->forget('cart');

        return redirect('/')->with('success', 'Checkout complete! Thank you for your purchase.');
    }
}
