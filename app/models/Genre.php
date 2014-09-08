<?php
class Genre extends Eloquent
{
    protected $table = "genre";
    
    public static $rules = array(
        'name'=>'required|max:50');
    
    public function album()
    {
        return $this->hasMany('Album');
    }
}
?>
