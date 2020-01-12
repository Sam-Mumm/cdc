<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    protected $table = "artist";

    public static $rules = array(
        'first_name' => 'sometimes|min:1|max:50',
        'last_name' => 'required|min:1|max:50'
    );

    public function track()
    {
        return $this->hasMany('track');
    }

    public function album_artist()
    {
        return $this->hasMany('album_artist');
    }

}
