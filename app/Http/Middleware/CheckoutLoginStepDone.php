<?php

namespace App\Http\Middleware;

use Closure;

class CheckoutLoginStepDone
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
        /* NOTE Cek apakah sudah login, atau sudah memasukkan email saat role guest */
        if (auth()->guest() && !session()->has('checkout.email')) {
            return redirect('checkout/login');
        }

        return $next($request);
    }
}
