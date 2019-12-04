<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use Illuminate\Http\Request;

class CatalogsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $q = $request->q;

        if ($request->has('cat') && $request->cat != '') {
            $cat = $request->cat;
            $category = Category::findOrFail($cat);
            // Mencari product yang memiliki id product sama dengan related_products_id
            $products = Product::whereIn('id', $category->related_products_id)->where('name', 'LIKE', '%' . $q . '%')->paginate(4);
            // return view('catalog.index', compact('products', 'cat'));
        } else {
            $products = Product::where('name', 'LIKE', '%' . $q . '%')->paginate(4);
            return view('catalog.index', compact('products', 'q'));
        }

        if ($request->has('sort')) {
            $sort = $request->get('sort');
            $order = $request->has('order') ? $request->get('order') : 'asc';
            $field = in_array($sort, ['price', 'name']) ? $request->get('sort') : 'price';
            $products = $products->orderBy($field, $order);
        }

        return view('catalog.index', compact('products', 'q'))->with(['cat' => $cat, 'category' => $category]);
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
