<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    public function modelable()
    {
        return $this->morphTo();
    }
}
