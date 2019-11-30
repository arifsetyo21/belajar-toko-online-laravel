@extends('layouts.app')

@section('content')
    <div class="container">
       <div class="row">
          <div class="col-md-12">
             <h3>New Category</h3>
               <form action="{{route('categories.store')}}" method="post">
                  @include('category._form')
               </form>
          </div>
       </div>
    </div>
@endsection