<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Game;

class CategoryController extends Controller
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
}
