@extends('layouts.app')

@section('content')
    <div class="container">
       <div class="row">
          <div class="col-md-12">
             <h3>New Product</h3>
               <form action="{{route('products.update', ['id' => $product->id])}}" method="post" enctype="multipart/form-data">
                  <input type="hidden" name="_method" value="PUT">
                  @include('product._form', ['product' => $product])
               </form>
          </div>
       </div>
    </div>
@endsection

@section('script')

@endsection