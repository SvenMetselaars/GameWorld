<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Platform;
use App\Models\Category;
use App\Models\Game;

class PlatformController extends Controller
{
    public function getPlatforms(Request $request)
    {
        $platforms = Platform::all();
        $categories = Category::all();
        $activePlatform = $request->get('platform', 'index');
        $activeCategory = 0;

        $games = Game::when($activePlatform && $activePlatform !== 'index', function ($query) use ($activePlatform) {
            $query->where('platform_id', $activePlatform);
        })->get();

        return view('platform', compact('platforms', 'activePlatform', 'games'));
    }
}
