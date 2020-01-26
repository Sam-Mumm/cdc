<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class AlbumArtists extends Pivot
{
    protected $table = "album_artist";
}