<?php

namespace App\Http\Controllers\Auth;

use Auth;
use Illuminate\Http\Request;
use App\Support\CartService;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /* NOTE Doing something setelah terauthentikasi dengan menambahkan method authenticated() */
    public function authenticated(Request $request){
        /* NOTE Cek apakah user memiliki hak aksese sebagai customer-access, Disini kita mengecek apakah user yang login seorang customer dengan menggunakan gate: */
        if($request->user()->can('customer-access')){
            /* NOTE Merge cart dengan menggunakan method yang ada dicart service  */
            $cookie = $this->cart->merge();
            return redirect('/home')->withCookie($cookie);
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(CartService $cart)
    {
        $this->middleware('guest')->except('logout');
        /* NOTE Instansiasi CartService yang akan digunakan untuk merge cart */
        $this->cart = $cart;
    }
}
