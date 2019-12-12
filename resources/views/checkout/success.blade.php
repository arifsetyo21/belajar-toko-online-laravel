@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row mt-3">
      <div class="col-md-8">
         <div class="card">
            <div class="card-header">
               Berhasil!!!
            </div>
            <div class="card-body">
               <h5 class="card-title">Hi, <strong>{{session('order')->user->name}}</strong></h5>
               <p class="card-text">
                  Terima kasih telah berbelanja di Reselia. <br>
                  Untuk melakukan pembayaran dengan <strong>{{config('bank-accounts')[session('order')->bank]['title']}}</strong> : 
                  <ol>
                     <li>Silahkan transfer ke rekening <strong>{{config('bank-accounts')[session('order')->bank]['number']}} An. {{config('bank-accounts')[session('order')->bank]['name']}}</strong></li>
                     <li>Ketika melakukan pembayaran sertakan nomor pesanan <strong>{{session('order')->padded_id}}</strong></li>
                     <li>Total pembayaran <strong>Rp{{number_format(session('order')->total_payment)}}</strong></li>
                  </ol>
               </p>
            </div>
            <div class="card-footer text-muted">
                  <a href="{{url('catalogs')}}" class="btn btn-primary"><i class="fa fa-shopping-bag" aria-hidden="true"></i> Lanjut Belanja</a>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection