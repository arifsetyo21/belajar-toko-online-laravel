@extends('layouts.app')

@section('content')
    <div class="container">
       @include('checkout._step')
       <div class="row mt-3">
          <div class="col-md-8">
             <div class="card">
                <div class="card-header">Alamat Pengiriman</div>
                <div class="card-body">
                   @include('checkout._address-new-form')
                </div>
             </div>
          </div>
          <div class="col-md-4">
            <div class="card">
               <h5 class="card-header">Cart</h5>
               <div class="card-body">
                  @include('checkout._cart-panel')
               </div>
            </div>
          </div>
       </div>
    </div>
@endsection

@section('script')
    
@endsection