<?php
class Track extends Eloquent
{
    protected $table = "track";
    
    public function artist()
    {
        return $this->belongsTo('Artist');
    }
    
}
