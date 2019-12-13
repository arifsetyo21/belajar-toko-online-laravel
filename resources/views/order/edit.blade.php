@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row">
      <div class="col-md-12">
         <h3>Edit {{$order->title}}</h3>
         <form action="{{route('orders.update', ['id' => $order->id])}}" method="post">
            <input type="hidden" name="_method" value="PUT">
            @include('order._form', ['order' => $order])
         </form>
      </div>
   </div>
</div>
@endsection