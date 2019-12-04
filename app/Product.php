<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'photo', 'model', 'price'];

    public function categories()
    {
        return $this->belongsToMany('App\Category');
    }

    /**
     * Accessor photo_path
     * 
     * Get all photo_path with full link
     * */ 
    public function getPhotoPathAttribute(){
        if($this->photo !== ''){
            return url('/img/' . $this->photo);
        } else {
            return 'http://placehold.it/850x618';
        }
    }
}
