<?php

namespace App;


use Notifiable;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['title', 'parent_id'];

    public function childs()
    {
        return $this->hasMany('App\Category', 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo('App\Category', 'parent_id');
    }

    public function products()
    {
        return $this->belongsToMany('App\Product');
    }
    
    // protected $dispatchesEvents = [
    //     'deleting' => CategoryDeleting::class,
    // ];
    // public function deleting(Category $category) {
    //     // remove relation with product
    //     $cat->products()->detach();
    // };
}
