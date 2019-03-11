<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    public function playerable()
    {
        return $this->morphTo();
    }
}
