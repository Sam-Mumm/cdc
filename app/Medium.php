<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medium extends Model
{
    protected $table = "medium";
    protected $fillable = ['name'];

    public function album(): HasMany
    {
        return $this->hasMany(Album::class);
    }
}
