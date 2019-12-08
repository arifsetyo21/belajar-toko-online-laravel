<?php

namespace App;

use App\Fee;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'photo', 'model', 'price', 'weight'];

    protected $appends = ['photo_path'];

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

    public function carts()
    {
        return $this->hasMany('App\Cart');
    }

    public function getCostTo($destination_id){
        return Fee::getCost(
            config('rajaongkir.origin'),
            $destination_id,
            (int) $this->weight,
            config('rajaongkir.courier'),
            config('rajaongkir.service')
        );
    }
}
