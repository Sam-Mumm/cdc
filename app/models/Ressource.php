<?php
class Ressource extends Eloquent
{
    protected $table = "ressource";
    
    public static $rules = array(
        'medium'=>'required|max:50');
    
    public function album()
    {
        return $this->hasMany('Album');
    }
}
?>

