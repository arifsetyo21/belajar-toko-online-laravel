<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\MessageBag;
use App\Http\Requests\CheckoutLoginRequest;

class CheckoutController extends Controller
{
    public function login(){
        return view('checkout.login');
    }

    public function postLogin(CheckoutLoginRequest $request){
        $email = $request->get('email');
        // return dd($email);
        $password = $request->checkout_password;
        $is_guest = $request->is_guest > 0;

        if ($is_guest) {
            return $this->guestCheckout($email);
        }

        return $this->authenticatedCheckout($email, $password);
    }

    public function guestCheckout($email){
        /* NOTE Cek user exist, jika ada maka harus dimintai login  */
        if ($user = User::where('email', $email)->first()) {
            if ($user->hasPassword()) {
                /* NOTE Logic ketika email ada di DB dengan password */
                $errors = new MessageBag();
                $errors->add('checkout_password', 'Alamat Email "' . $email . '" sudah terdaftar, silahkan masukkan password');
                /* NOTE Redirect dan ubah is_guest value */
                return redirect('/checkout/login')->withErrors($errors)->withInput(compact('email') + ['is_guest' => 0]);
            }
            /* NOTE Logic ketika email di db tanpa password */
            /* NOTE Show view to request new password */
            session()->flash('email', $email);
            return view('checkout.reset-password');
        }

        /* NOTE Logic ketika email tidak ada di db */
        /* NOTE Simpan user data ke session */
        session(['checkout.email' => $email]);
        return redirect()->route('checkout.address');
    }
    
    public function authenticatedCheckout($email, $password){
        return 'logic untuk authenticated checkout belum dibuat';
    }
}
