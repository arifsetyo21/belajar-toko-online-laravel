@extends('layouts.app')

@section('content')
    <div class="container">
       @include('checkout._step')
       <div class="row mt-3">
          <div class="col-md-8">
            <div class="card">
               <h5 class="card-header">Permintaan Password</h5>
               <div class="card-body">
                  @include('checkout._request-password-form')
               </div>
            </div>
          </div>
       </div>
    </div>
@endsection