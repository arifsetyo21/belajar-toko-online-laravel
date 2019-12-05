<?php

namespace App\Http\Controllers;

use Session;
use App\Cart;
use App\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cart $cart)
    {
        //
    }

    public function addProduct(Request $request){
        \Validator::make($request->all(), [
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ])->validate();

        $product = Product::findOrFail($request->get('product_id'));
        $quantity = $request->get('quantity');

        
        /*
        NOTE
            - melakukan unserialize cookie yang telah diserialize
            - mengambil nilai cookie untuk key cart dan membuat isian defaultnya array kosong
        */        
        $cart = unserialize($request->cookie('cart', []));
        // Cek apakah id produk sudah ada di $cart
        if(array_key_exists($product->id, $cart)){
            $quantity += $cart[$product->id];
        }

        Session::flash('flash_product_name', $product->name);
        // mengisi array $cart dengan quantity dan product_id
        $cart[$product->id] = $quantity;

        // melakukan Serialize cart karena cookie pada laravel tidak mendukung array, maka harus diseialize
        $cart = serialize($cart);

        return redirect('catalogs')->withCookie(cookie()->forever('cart', $cart));
    }
}

