<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Card extends Model
{
    protected $table = 'cards';

    protected $guarded = [
    ];

    const STATUS_LIVE = 'live';
    const STATUS_DIE = 'die';
    const STATUS_NEGATIVE = 'negative';

    public function player()
    {
        return $this->morphOne(Player::class, 'playerable');
    }

    public function cardeable()
    {
        return $this->morphTo('cardeable', 'model_type', 'model_id');
    }

    public function rpg()
    {
        return $this->belongsTo(Rpg::class);
    }

    public function status()
    {
        return $this->belongsToMany(Status::class, 'status_players', 'card_id', 'status_id');
    }

    public static function getRaces(){
        $racesArray = [
            "Anão",
            "Elfo",
            "Halfling",
            "Gnomo",
            "Meio-Elfo",
            "Humano",
            "Orc",
            "Meio-Orc",
            "Draconato",
            "Tiefling"
        ];


        $races = new Collection();

        foreach($racesArray as $race){
            $races->push($race);
        }

        return $races->sort();
    }

    public static function getClasses(){
        $classArray = [
            "Bárbaro",
            "Bardo",
            "Bruxo",
            "Clérigo",
            "Druida",
            "Feiticeiro",
            "Guerreiro",
            "Ladino",
            "Mago",
            "Monge",
            "Paladino",
            "Patrulheiro",
        ];


        $classes = new Collection();

        foreach($classArray as $class){
            $classes->push($class);
        }

        return $classes->sort();
    }
}
