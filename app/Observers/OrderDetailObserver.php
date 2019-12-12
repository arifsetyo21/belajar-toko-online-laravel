<?php

namespace App\Observers;

use App\OrderDetail;

class OrderDetailObserver
{
    /**
     * Handle the order detail "created" event.
     *
     * @param  \App\OrderDetail  $orderDetail
     * @return void
     */
    public function created(OrderDetail $orderDetail)
    {
        /* NOTE mengupdate table order_details pada field total_price ketika record berhasil dibuat */
        if($orderDetail->total_price < 1){
            $orderDetail->refreshTotalPrice();
        }

        /* NOTE Mengupdate field total_payment pada table orders */
        $orderDetail->order->refreshTotalPayment();
    }

    /**
     * Handle the order detail "updated" event.
     *
     * @param  \App\OrderDetail  $orderDetail
     * @return void
     */
    public function updated(OrderDetail $orderDetail)
    {

    }

    /**
     * Handle the order detail "deleted" event.
     *
     * @param  \App\OrderDetail  $orderDetail
     * @return void
     */
    public function deleted(OrderDetail $orderDetail)
    {
        //
    }

    /**
     * Handle the order detail "restored" event.
     *
     * @param  \App\OrderDetail  $orderDetail
     * @return void
     */
    public function restored(OrderDetail $orderDetail)
    {
        //
    }

    /**
     * Handle the order detail "force deleted" event.
     *
     * @param  \App\OrderDetail  $orderDetail
     * @return void
     */
    public function forceDeleted(OrderDetail $orderDetail)
    {
        //
    }
}
