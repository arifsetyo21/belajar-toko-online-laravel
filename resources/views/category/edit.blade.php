@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row">
      <div class="col-md-12">
         <h3>Edit Category</h3>
         <form action="{{route('categories.update', ['category' => $category])}}" method="post">
            <input type="hidden" class="form-control" name="_method" value="put" placeholder="">
               @include('category._form', ['category' => $category])
         </form>
      </div>
   </div>
</div>
@endsection