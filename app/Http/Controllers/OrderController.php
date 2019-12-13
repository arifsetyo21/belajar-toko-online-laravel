<?php

namespace App\Http\Controllers;

use Flash;
use App\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
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
        $q = '';
        $status = $request->status;
        $orders = Order::where('status', 'LIKE', '%' . $status . '%');
        if($request->has('q')){
            $q = $request->q;
            $orders = $orders->where('orders.id', $q)
                            ->orWhereHas('user', function($user) use ($q) {
                                $user->where('name', 'LIKE', '%' . $q . '%');
                            });
        }

        $orders = $orders->orderBy('updated_at', 'desc')->paginate(10);

        return view('order.index', \compact('orders', 'status', 'q'));
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
        $order = Order::find($id);
        return view('order.edit')->with(\compact('order'));
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
        $order = Order::find($id);
        \Validator::make($request->all(), [
            'status' => 'required|in:' . implode(',', Order::allowdStatus())
        ])->validate();
        
        $order->update($request->only('status'));
        Flash::success($order->padded_id . ' Berhasil disimpan')->important();
        return redirect()->route('orders.index');
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
