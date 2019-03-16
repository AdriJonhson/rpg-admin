<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rpg extends Model
{
    protected $fillable = ['title', 'description'];

    public function players()
    {
        return $this->morphedByMany(Player::class, 'model', 'rpg_players', 'rpg_id');
    }
}
