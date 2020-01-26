<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CD extends Model
{
    protected $table = "cd";
    protected $fillable = [
        'cd_no'
    ];

    public function album(): BelongsTo
    {
        return $this->belongsTo(Album::class);
    }


}
