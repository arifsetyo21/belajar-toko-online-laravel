<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $table = 'order_details';

    protected $fillable = ['id', 'order_id', 'product_id', 'quantity', 'price', 'fee', 'total_price'];

    public function product()
    {
        return $this->belongsTo('App\Product');
    }

    public function order()
    {
        return $this->belongsTo('App\Order');
    }

    /* NOTE Update field total_price pada table order_details */
    public function refreshTotalPrice(){ 
        $total_price = ($this->price + $this->fee) * $this->quantity;
        $this->total_price = $total_price;
        $this->save();
    }
}
