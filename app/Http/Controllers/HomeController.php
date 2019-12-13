<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['only' => ['index', 'viewOrders']]);
        $this->middleware('role:customer', ['only' => 'viewOrders']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // return view('home');
        return redirect()->route('catalogs.index');
    }

    public function viewOrders(Request $request){
        $q = $request->get('q');
        $status = $request->get('status');
        $orders = auth()->user()->orders()
                    ->where('id', 'LIKE', '%' . $q . '%')
                    ->where('status', 'LIKE', '%' . $status . '%')
                    ->orderBy('updated_at')
                    ->paginate(5);
        return view('customer.view-orders')->with(\compact('orders', 'status', 'q'));
    }
}
