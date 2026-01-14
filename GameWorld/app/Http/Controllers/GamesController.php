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
        $games = Game::with(['categories', 'platform'])->get();

        return view('info', compact('games'));
    }
}
