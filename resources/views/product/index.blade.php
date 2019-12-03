@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row">
      <div class="col-md-12">
         <h3>Product <small><a href="{{route('products.create')}}" class="btn btn-success btn-sm"> New Product</a></small></h3>
         <form action="{{route('products.index')}}" method="get" class="form-inline">
            <div class="form-group">
               <label for="search" class="sr-only"></label>
               <input type="text"
                  class="form-control mr-2" id="search" name="q" aria-describedby="helpId" placeholder="Type name of product...">
            </div>
            <button type="submit" class="btn btn-primary btn-sm">Search</button>
         </form>

         <table class="table mt-2">
            <thead>
               <tr>
                  <th>Name</th>
                  <th>Model</th>
                  <th>Category</th>
                  <th></th>
               </tr>
            </thead>
            <tbody>
               @foreach ($products as $product)    
               <tr>
                  <td scope="row">{{$product->name}}</td>
                  <td>{{$product->model}}</td>
                  <td>
                     @foreach ($product->categories as $category)
                        <span class="badge badge-primary"><i class="fa fa-btn fa-tags"></i>{{$category->title}}</span>
                     @endforeach
                  </td>
                  <td>
                     <a class="float-left mr-2" href="{{route('products.edit', ['id' => $product->id])}}">Edit</a>
                     <form class="form-inline" action="{{route('products.destroy', ['id' => $product->id])}}" method="post">
                        @csrf
                        <input type="hidden" name="_method" value="delete">
                        <button type="submit" class="btn btn-danger btn-sm float-right">Delete</button>
                     </form>
                  </td>
               </tr>
               @endforeach
            </tbody>
         </table>
      </div>
   </div>
</div>
@endsection