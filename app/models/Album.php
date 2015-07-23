<?php
class Album extends Eloquent
{
    protected $table = "album";
    protected $fillable = array('title', 'year', 'genre_id','artist_id','category_id','ressource_id');
    
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
    
    public function cd()
    {
        return $this->hasMany('CD');        
    }
}
?>
