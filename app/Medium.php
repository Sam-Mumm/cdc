<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Medium extends Model
{
    protected $table = "medium";
    protected $fillable = ['name'];

    public function album(): HasMany
    {
        return $this->hasMany(Album::class);
    }
}
