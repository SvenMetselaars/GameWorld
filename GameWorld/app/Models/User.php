<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    // MANY-TO-MANY: Aankopen
    public function purchasedGames()
    {
        return $this->belongsToMany(Game::class, 'game_user')
                    ->withTimestamps();
    }

    // MANY-TO-MANY: Wishlist
    public function wishlist()
    {
        return $this->belongsToMany(Game::class, 'game_user_wishlist')
                    ->withTimestamps();
    }
}
