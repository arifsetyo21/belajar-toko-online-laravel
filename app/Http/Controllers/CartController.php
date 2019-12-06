<?php

namespace App\Http\Controllers;

use Auth;
use Flash;
use Session;
use App\Cart;
use App\Product;
use Illuminate\Http\Request;
use App\Support\CartService;

class CartController extends Controller
{

    protected $cart;

    /* NOTE instansiasi service CartService CartController dipanggil dan memasukkan ke arttibute $cart*/
    public function __construct(CartService $cart){
        return $this->cart = $cart;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /* NOTE Menampilkan cart.index */
    public function index()
    {
        return view('cart.index');
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

    /* NOTE Menambahkan product ke cart yang ada dicookie */
    public function addProduct(Request $request){

        /* NOTE Membuat validasi dari inputan */
        \Validator::make($request->all(), [
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ])->validate();

        $product = Product::findOrFail($request->get('product_id'));
        $quantity = $request->get('quantity');
        
        $cart = [];

        /* NOTE Cek apakah user sudah login */
        if (Auth::check()) {
            $cart = Cart::firstOrCreate([
                'product_id' => $product->id,
                'user_id' => $request->user()->id,
                'quantity' => $quantity
            ]);

            $cart->quantity += $quantity;
            $cart->save();
            return redirect('/catalogs');
        } else {
            /* NOTE Mengatatasi error apabila cookie 'cart' kosong */
            if (!$this->cart->isEmpty()) {
                /*
                NOTE
                    - melakukan unserialize cookie yang telah diserialize
                    - mengambil nilai cookie untuk key cart dan membuat isian defaultnya array kosong
                */        
                $cart = unserialize($request->cookie('cart', []));            
            }
    
            // Cek apakah id produk sudah ada di $cart
            if(array_key_exists($product->id, $cart)){
                $quantity += $cart[$product->id];
            }
    
            /* NOTE Membuat flash message dengan key 'flash_product_name' */
            Session::flash('flash_product_name', $product->name);
            // mengisi array $cart dengan quantity dan product_id
            $cart[$product->id] = $quantity;
    
            /* NOTE melakukan Serialize cart karena cookie pada laravel tidak mendukung array, maka harus diseialize */
            $cart = serialize($cart);
    
            /* NOTE Redirect ke routing catalogs dan membuat cookie cart dari variabel cart dengan masa berlaku 5 tahun */
            return redirect('catalogs')->withCookie(cookie()->forever('cart', $cart));
        }
        
    }

    /* NOTE menghapus product dari $product_id yang dikirim */
    public function removeProduct(Request $request, $product_id){

        /* NOTE Menambahkan pengecekan user authentikasi atau belum */
        if (Auth::check()) {
            /* NOTE Cari product berdasarkan id atau user id */
            $cart = Cart::firstOrCreate([
                'product_id' => $product_id,
                'user_id' => $request->user()->id,
            ]);

            /* NOTE Delete record */
            $cart->delete();
            return redirect('cart');
        } else {
            /* NOTE Mencari product_id dengan method yang dibuat di CartService */
            $cart = $this->cart->find($product_id);
    
            /* NOTE Jika kosong maka langsung redirect ke cart tanpa flash message  */
            if (!$cart) return redirect('cart');
    
            /* NOTE Membuat flash message dengan teks di bawah dan menggunakan method important() agar menampilkan close button */
            Flash::success($cart['detail']['name'] . ' Berhasil dihapus dari cart')->important();
    
            /* NOTE Mengambil cookie 'cart' yang belum dilakukan pengurangan */
            $cart = unserialize($request->cookie('cart', []));
    
            /* NOTE Menghapus product pada $cart*/
            unset($cart[$product_id]);
    
            /* NOTE Redirect ke halaman cart, dengan membuat cookie yang baru dengan key 'cart'  */
            return redirect('cart')->withCookie(cookie()->forever('cart', serialize($cart)));
        }
    }

    /* NOTE Update jumlah product dikeranjang */
    public function updateProduct(Request $request, $product_id){
        
        \Validator::make($request->all(), [
            'quantity' => 'required|min:1|integer'
        ])->validate();

        /* NOTE Cek authentikasi user */
        if (Auth::check()) {
            /* NOTE Cari record user di database */
            $cart = Cart::firstOrCreate([
                'user_id' => $request->user()->id,
                'product_id' => $product_id
            ]);

            /* NOTE Ubah quantity product */
            $cart->quantity = $request->quantity;
            $cart->save();
            return redirect('cart');
        } else {
            /* NOTE Ambil data cart di cookie */
            $cart = unserialize($request->cookie('cart'));
    
            /* NOTE jika tidak ketemu balikkan error */
            if (!$product = Product::find($product_id)) {
                Flash::error('Gagal mengubah jumlah produk')->important();
                return back();
            }
            
            /* NOTE jika ada ubah jumlah product dikeranjang */
            $cart[$product_id] = $request->quantity;
    
            Flash::success($product['name'] . ' Cart berhasil diubah')->important();
            return back()->withCookie(cookie()->forever('cart', serialize($cart)));
        }

    }
}

