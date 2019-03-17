<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Rpg extends Model
{
    use HasSlug;

    protected $fillable = ['title', 'description', 'slug'];

    public function players()
    {
        return $this->morphedByMany(Player::class, 'model', 'rpg_players', 'rpg_id');
    }


    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug')
            ->usingSeparator('_');
    }
}
