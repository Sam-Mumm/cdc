<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medium extends Model
{
    protected $table = "medium";
    protected $fillable = array('name');

    public static $rules = array(
        'name' => 'required|min:1|max:50'
    );

    public function album()
    {
        return $this->hasMany('Album');
    }
}
