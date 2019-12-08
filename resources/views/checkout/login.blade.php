@extends('layouts.app')

@section('content')
   <div class="container">
      <div class="card text-center">
         @include('checkout._step')
      </div>
      <div class="row mt-3">
         <div class="col-sm-8">
            <div class="card">
            <h5 class="card-header">Login atau Checkout tanpa mendaftar</h5>
               <div class="card-body">
                  @if (session('status'))
                      <div class="alert alert-success">
                         {{session('status')}}
                      </div>
                  @endif
                  @include('checkout._login-form')
               </div>
            </div>
         </div>
         <div class="col-sm-4">
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
    $(document).ready(function() {
      if($('input[name=checkout_password]').lenght > 0 && $('input[name=is_guest]').lenght > 0 && $('input[name=is_guest]:checked').val() > 0) {
         $('input[name=checkout_password]').prop('disabled', true)
      }
    })
@endsection