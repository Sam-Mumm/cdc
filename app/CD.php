<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CD extends Model
{
    protected $table = "cd";
    public static $rules = array(
        'name' => 'required|integer|min:1'
    );

    public function album()
    {
        return $this->belongsTo('Album');
    }


}
