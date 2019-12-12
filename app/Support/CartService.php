<?php

namespace App\Support;

use Auth;
use Cookie;
use App\Cart;
use App\Product;
use App\Address;
use Illuminate\Http\Request;

class CartService {

   /**
    * NOTE Cart service dibuat untuk melayani pengelolaan cart, karena cart menggunakan cookie bukan orm
   */
   protected $request;

   /* NOTE Membuat instance CartService dari request yang masuk */
   public function __construct(Request $request){
      $this->request = $request;
   }

   /* NOTE ambil product yang ada cookie dengan key cart */ 
   public function lists(){

      /* NOTE Membedakan cara mengambil product di table cart atau di cookie */
      if(Auth::check()) {
         return Cart::where('user_id', Auth::user()->id)->pluck('quantity', 'product_id');
      } else {
         return unserialize($this->request->cookie('cart'));
      }
   }

   /* NOTE Hitung total product yang ada dilists */
   public function totalProduct(){
      
      /* NOTE Mengatasi apabila keranjang masih kosong */
      if ($this->lists() == null) {
         return 0;
      }

      return count($this->lists());
   }

   /* NOTE Cek apakah total product dicart kosong */
   public function isEmpty(){
      return $this->totalProduct() < 1;
   }

   /* NOTE Cek jumlah total product yang ada di cart */
   public function totalQuantity(){
      $total = 0;
      
      if ($this->totalProduct() > 0) {
         foreach ($this->lists() as $id => $quantity) {
            $product = Product::find($id);
            $total += $quantity;
         }
      }
      return $total;
   }

   /* NOTE Mengambil detail product untuk semua product yang ada di cart */
   public function details(){

      $details = [];

      if ($this->totalProduct() > 0) {
         foreach ($this->lists() as $id => $quantity) {
            $product = Product::find($id);
            array_push($details, [
               'id' => $id,
               'detail' => $product->toArray(),
               'quantity' => $quantity,
               'subtotal' => $product->price * $quantity,
            ]);
         }
      }

      return $details;
   }

   /* NOTE Menghitung total price yang ada di cart */
   public function totalPrice(){      
      $total_price = 0;

      foreach ($this->details() as $order) {
         $total_price += $order['subtotal'];
      }

      return $total_price;
   }

   /* NOTE Mencari product dengan $product_id dan mengembalikan detail product */
   public function find($product_id){
      
      foreach ($this->details() as $order) {
         if ($order['id'] == $product_id) return $order;
      }
      
      return null;
   }

   public function merge(){

      $cart_cookie = [];

      if ($this->request->cookie('cart', []) != null) {
         $cart_cookie = unserialize($this->request->cookie('cart', []));
      }
      
      foreach ($cart_cookie as $product_id => $quantity) {
         $cart = Cart::firstOrCreate([
            'user_id' => $this->request->user()->id,
            'product_id' => $product_id,
            'quantity' => $quantity
         ]);

         $cart->quantity = $cart->quantity > 0 ? $cart->quantity : $quantity;
         $cart->save();
      }

      return Cookie::forget('cart');
   }

   protected function getDestinationId(){

      if (Auth::check() && session()->has('checkout.address.address_id')) {
         $address = Address::find(session('checkout.address.address_id'));
         return $address->regency_id;
      }

      return session('checkout.address.regency_id');
   }

   public function shippingFee(){
      $totalFee = 0;
         foreach ($this->lists() as $id => $quantity) {
         $fee = Product::find($id)->getCostTo($this->getDestinationId()) * $quantity;
         $totalFee += $fee;
      }

      return (int) $totalFee;
   }

   public function clearCartCookie(){
      return Cookie::forget('cart');
   }

   public function clearCartRecord(){
      return Cart::where('user_id', Auth::user()->id)->delete();
   }
}