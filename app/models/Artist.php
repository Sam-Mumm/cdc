<?php
class Artist extends Eloquent
{
    protected $table = "artist";
    
    public static $rules = array(
        'first_name'=>'sometimes|max:50',
        'last_name'=>'required|max:255');
    
    public function album()
    {
        return $this->hasMany('Album');
    }
    
    public function track()
    {
        return $this->hasMany('Track');
    }
}
?>
