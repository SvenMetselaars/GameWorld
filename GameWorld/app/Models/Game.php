<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $fillable = [
        'title',
        'info',
        'price',
        'rating',
        'platform_id',
    ];

    /**
     * ONE-TO-MANY: Game belongs to Platform
     */
    public function platform()
    {
        return $this->belongsTo(Platform::class);
    }

    /**
     * MANY-TO-MANY: Game has many Categories
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    // Users who purchased this game
    public function buyers()
    {
        return $this->belongsToMany(User::class, 'game_user')
                    ->withTimestamps();
    }

    // Users who have this game in wishlist
    public function wishers()
    {
        return $this->belongsToMany(User::class, 'game_user_wishlist')
                    ->withTimestamps();
    }
}