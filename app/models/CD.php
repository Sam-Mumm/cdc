<?php
class CD extends Eloquent
{
    protected $table = "cd";
    
    public function album()
    {
        return $this->belongsTo('Album');
    }
    
}
