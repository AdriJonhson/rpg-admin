<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\Rpg;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class CardController extends Controller
{
    public function create(Request $request, Rpg $rpg)
    {
        config(['adminlte.collapse_sidebar' => true]);

        $races = Card::getRaces();
        $classes = Card::getClasses();

        return view('admin.cards.create', compact('races', 'classes'));
    }
}
