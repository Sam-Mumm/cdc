<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Genre extends Model
{
    protected $table = "genre";
    protected $fillable = ['name'];

    public function album(): HasMany
    {
        return $this->hasMany(Album::class);
    }
}
