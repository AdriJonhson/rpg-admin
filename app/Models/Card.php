<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    protected $table = 'cards';

    protected $fillable = [

    ];

    public function player()
    {
        return $this->morphOne(Player::class, 'playerable');
    }
}
