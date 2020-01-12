<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = "category";
    public static $rules = array(
        'name' => 'required|min:1|max:50',
        'show_artist' => 'sometimes|boolean'
    );

    public function album()
    {
        return $this->hasMany('Album');
    }
}
