<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Support\CartService;
use App\Repositories\UserRepository;

class CartComposer {

   public function __construct(CartService $cart){
      $this->cart = $cart;
   }

   public function compose(View $view){
      $view->with('cart', $this->cart);
   }
}