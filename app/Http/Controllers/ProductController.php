<?php

namespace App\Http\Controllers;

use File;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class ProductController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
        $this->middleware('role:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $q = $request->q;
        $products = Product::where('name', 'LIKE', '%'.$q.'%')
                    ->orWhere('model', 'LIKE', '%'.$q.'%')
                    ->orderBy('name')->paginate(10);

        return view('product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        \Validator::make($request->all(), [
            'name' => 'required|unique:products',
            'model' => 'required',
            'photo' => 'mimes:jpeg,png|max:10240', //validasi foto hanya menggunakan extensi jpeg, dan png, ukuran maksimal 10MB
            'price' => 'required|numeric|min:1000'
        ])->validate();

        // Hanya mengambil variabel name, model dan price
        $data = $request->only('name', 'model', 'price');

        if ($request->hasFile('photo')) {
            // menyimpan foto dengan menggunakan method yang dibuat sendiri
            $data['photo'] = $this->savePhoto($request->file('photo'));
        }

        $product = Product::create($data);
        // setelah data berhasil disimpan, kemudian data juga disimpan pada tabel relasi categories dengan method sync()
        $product->categories()->sync($request->get('category_lists'));

        // Memberikan feedback apabila telah sukses tersimpan
        \Flash::success($product->name . ' saved')->important();
        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('product.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        // Lakukan validasi input
        \Validator::make($request->all(), [
            'name' => 'required|unique:products,name,'.$product->id,
            'model' => 'required',
            'photo' => 'mimes:jpeg,png|max:10240',
            'price' => 'required|numeric|min:1000'
        ])->validate();

        $data = $request->only('name', 'model', 'price');

        // update nama file saat ada file 
        if ($request->hasFile('photo')) {
            $data['photo'] = $this->savePhoto($request->file('photo'));
            if ($product->photo !== null) $this->deletePhoto($product->photo);
        }

        $product->update($data);
        if (count($request->get('category_lists')) > 0) {
            $product->categories()->sync($request->category_lists);
        } else {
            // no category set, detach all
            $product->categories()->detach();
        }

        \Flash::success($product->name . ' updated')->important();
        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        // menghapus foto apabila ditemukan field foto pada record photo terisi
        if($product->photo !== null || $product->photo !== '') $this->deletePhoto($product->photo);
        $product->delete();
        \Flash::success('Product deleted.')->important();
        return \redirect()->route('products.index');
    }

    /**
     * Method untuk upload foto dan generate photo name
     * 
     * @param Illuminate\Http\UploadedFile
     * @return string $fileName
     * 
     */
    public function savePhoto(UploadedFile $photo){
        // membuat nama file 40 karakter random dan menggabungkan dengan extensi
        $fileName = str_random(40) . '.' .$photo->guessClientExtension();
        // simpan kedalam folder public/img, untuk menghidari error saat menggunakan unix ataupun windows karena berbeda pada separator directory
        $destinationPath = \public_path() . DIRECTORY_SEPARATOR . 'img';
        // pindahkan file ke tujuan yang diinginkan
        $photo->move($destinationPath, $fileName);
        // mengembalikan nama file yang tersimpan
        return $fileName;
    }

    public function deletePhoto($fileName) {
        $path = public_path() . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR . $fileName;
        // Facade File digunakan untuk lebih mudah dalam mengelola file
        return File::delete($path);
    }
}
