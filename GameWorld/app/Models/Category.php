<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
    ];

    /**
     * MANY-TO-MANY: Category has many Games
     */
    public function games()
    {
        return $this->belongsToMany(Game::class);
    }
}