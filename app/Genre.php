<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    protected $table = "genre";
    public static $rules = array(
        'name' => 'required|min:1|max:50'
    );

    public function album()
    {
        return $this->hasMany('Album');
    }
}
