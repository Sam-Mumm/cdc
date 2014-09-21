<?php
class Album extends Eloquent
{
    protected $table = "album";
    
    public function artist()
    {
        return $this->belongsTo('Artist');
    }

    public function category()
    {
        return $this->belongsTo('Category');
    }

    public function genre()
    {
        return $this->belongsTo('Genre');
    }

    public function ressource()
    {
        return $this->belongsTo('Ressource');
    }    
}
?>
