<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $table = "category";
    protected $fillable = [
        'name',
        'show_artist'
    ];

    public function album(): HasMany
    {
        return $this->hasMany(Album::class);
    }
}
