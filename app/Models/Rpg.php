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
        return $this->morphedByMany(User::class, 'model', 'rpg_players', 'rpg_id');
    }


    public function cards()
    {
        return $this->hasMany(Card::class);
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
