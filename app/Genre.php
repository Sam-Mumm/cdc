<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Genre extends Model
{
    protected $table = "genre";

    public function album(): HasMany
    {
        return $this->hasMany(Album::class);
    }
}
