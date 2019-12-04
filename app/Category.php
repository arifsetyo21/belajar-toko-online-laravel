<?php

namespace App;

use Notifiable;
use App\Product;
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

    /**
     * Get all product id from active category and its child
     * */ 
    public function getRelatedProductsIdAttribute(){
        $result = $this->products->pluck('id')->toArray();
        foreach ($this->childs as $child) {
            $result = \array_merge($result, $child->related_products_id);
        }
        return $result;
    }

    /**
     * Memunculkan kategori tanpa parent
     */
    public function scopeNoParent($query){
        return $this->where('parent_id', '');
    }

    /**
     * Menjumlahkan total kategori pada sebuah kategori
     */
    public function getTotalProductsAttribute(){
        return Product::whereIn('id', $this->related_products_id)->count();
    }

    /**
     * Cek apakah memiliki child
     */
    public function hasChild(){
        return $this->childs()->count() > 0;
    }
    
    /**
     * Cek apakah memiliki parent
     */
    public function hasParent(){
        return $this->parent_id > 0;
    }
}
