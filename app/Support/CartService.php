<?php

namespace App\Support;

use App\Product;
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
      return unserialize($this->request->cookie('cart'));
   }

   /* NOTE Hitung total product yang ada dilists */
   public function totalProduct(){
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
}