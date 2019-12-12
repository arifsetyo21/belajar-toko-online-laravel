<?php

namespace App\Http\Middleware;

use Closure;

class CheckoutPaymentStepDone
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        /* NOTE Cek apakah sudah memiliki session order setelah selesai checkout payment */
        if (!session()->has('order')) {
            return \redirect('checkout/payment');
        }

        return $next($request);
    }
}
