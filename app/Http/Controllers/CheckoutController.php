<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use Illuminate\Support\MessageBag;
use App\Http\Requests\CheckoutLoginRequest;
use App\Http\Requests\CheckoutAddressRequest;

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

    public function address(){
        // $provinces = 
        return view('checkout.address');
    }

    public function postAddress(CheckoutAddressRequest $request){
        if (Auth::check()) return $this->authenticatedAddress($request);
        return $this->guestAddress($request);
    }

    protected function authenticatedAddress(CheckoutAddressRequest $request){
        return "Akan diisi untuk logic authenticated address";
    }

    protected function guestAddress(CheckoutAddressRequest $request){
        $this->saveAddressSession($request);
        return redirect('checkout/payment');
    }

    protected function saveAddressSession(CheckoutAddressRequest $request){
        session([
            'checkout.address.name' => $request->get('name'),
            'checkout.address.detail' => $request->get('detail'),
            'checkout.address.province_id' => $request->get('province_id'),
            'checkout.address.regency_id' => $request->get('regency_id'),
            'checkout.address.district_id' => $request->get('district_id'),
            'checkout.address.phone' => $request->get('phone')
        ]);
    }
}
