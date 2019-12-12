<?php

namespace App\Http\Middleware;

use Closure;
use App\Support\CartService;

class CheckoutHaveCart
{

    protected $cart;

    /* NOTE Instansiasi CartService pada constructor */
    public function __construct(CartService $cart){
        $this->cart = $cart;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

     /* NOTE Cek apakah cart sedang kosong, dan session dengan key order kosong atau tidak */
    public function handle($request, Closure $next)
    {
        if ($this->cart->isEmpty() && session()->get('order') == '') return redirect('cart');

        return $next($request);
    }
}
