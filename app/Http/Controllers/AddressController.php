<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Regency;

class AddressController extends Controller
{
    public function regencies(Request $request){
        \Validator::make($request->all(), [
            'province_id' => 'required|exists:provinces,id'
        ])->validate();

        return Regency::where('province_id', $request->get('province_id'))->get();

    }
}
