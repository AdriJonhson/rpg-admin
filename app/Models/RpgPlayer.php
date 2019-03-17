<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RpgPlayer extends Model
{
    protected $table = 'rpg_players';

    protected $fillable = ['rpg_id', 'model_id', 'model_type'];

    public function player()
    {
        return $this->morphTo();
    }

    public function rpg()
    {
        return $this->belongsTo(Rpg::class);
    }
}
