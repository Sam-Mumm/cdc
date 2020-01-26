<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Artist extends Model
{
    protected $table = "artist";
    protected $fillable = ['first_name', 'last_name'];

    public function track()
    {
        return $this->hasMany(Track::class);
    }

    public function albums(): BelongsToMany
    {
        return $this->belongsToMany(Album::class)->using(AlbumArtists::class);
    }

}
