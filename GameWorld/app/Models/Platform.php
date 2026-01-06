<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Platform extends Model
{
    protected $fillable = [
        'name',
    ];

    /**
     * ONE-TO-MANY: Platform has many Games
     */
    public function games()
    {
        return $this->hasMany(Game::class);
    }
}