<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Album extends Model
{
    protected $table = "album";

    protected $fillable = ['year', 'title', 'cover_path'];

    public function genre(): BelongsTo
    {
        return $this->belongsTo(Genre::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function medium(): BelongsTo
    {
        return $this->belongsTo(Medium::class);
    }

    public function artists(): BelongsToMany
    {
        return $this->belongsToMany(Artist::class)->using(AlbumArtists::class);
    }
}
