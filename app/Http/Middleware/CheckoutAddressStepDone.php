<?php

namespace App\Http\Middleware;

use Closure;
use App\Support\CartService;

class CheckoutAddressStepDone
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
        /* NOTE Melakukan check apakah memiliki session dengan key checkout.address.address.id */
        if (!session()->has('checkout.address.address_id')) {
            return redirect('checkout/address');
        }
        return $next($request);
    }
}
