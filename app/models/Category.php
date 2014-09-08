<?php
class Category extends Eloquent
{
    protected $table = "category";

    public static $rules = array(
        'name'=>'required|max:50',
        'show_artist'=>'sometimes|boolean');

    
    public function album()
    {
        return $this->hasMany('Album');
    }    
}
?>