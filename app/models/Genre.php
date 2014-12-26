<?php
class Genre extends Eloquent
{
    protected $table = "genre";
    
    public static $rules = array(
        'pk' => 'required|integer',
        'value'=>'required|max:50');
    
    public function album()
    {
        return $this->hasMany('Album');
    }
}
?>
