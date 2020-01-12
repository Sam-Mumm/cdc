<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Track extends Model
{
    protected $table = "track";

    public static $rules = array(
        'name' => 'required|min:1|max:75',
        'rating' => 'sometimes|integer|between:1,5',
    );

    public function artist()
    {
        return $this->belongsTo('Artist');
    }
}
