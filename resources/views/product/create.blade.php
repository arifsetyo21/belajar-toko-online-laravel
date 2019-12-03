@extends('layouts.app')

@section('content')
    <div class="container">
       <div class="row">
          <div class="col-md-12">
             <h3>New Product</h3>
               <form action="{{route('products.store')}}" method="post" enctype="multipart/form-data">
                  @include('product._form')
               </form>
          </div>
       </div>
    </div>
@endsection

@section('script')

@endsection