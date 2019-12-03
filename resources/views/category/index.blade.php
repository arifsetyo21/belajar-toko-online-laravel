@extends('layouts.app')

@section('content')
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <h3>Category</h3>
            <form action="{{route('categories.index')}}" method="get">
               <div class="form-group">
                  <label for="search-category">Category</label>
                  <input type="text"
                     class="form-control col-md-6 mr-0" name="q" id="search-category" aria-describedby="helpId" placeholder="Type Category" >
                  <small id="helpId" class="form-text text-muted">{{$errors->first('q')}}</small>
                  <button type="submit" class="btn btn-primary float-left">Search</button>
               </div>
            </form>
            <a name="" id="" class="btn btn-success float-right mb-3" href="{{route('categories.create')}}" role="button">New Category</a>
            <table class="table table-hover mt-3">
            <thead>
               <tr>
                  <td class="font-weight-bolder">Title</td>
                  <td class="font-weight-bolder">Parent</td>
                  <td></td>
               </tr>
            </thead>
            <tbody>
               @foreach ($categories as $category)
                     <tr>
                        <td>{{$category->title}}</td>
                        <td>{{$category->parent ? $category->parent->title : ''}}</td>
                        <td>
                           <a class="float-left mr-3" href="{{ route('categories.edit', $category->id)}}">Edit</a>
                           <form action="{{route('categories.destroy', ['category' => $category->id])}}" method="post">
                              @csrf
                              <input type="hidden" name="_method" value="delete">
                              <button type="submit" class="btn btn-danger btnDelete">Delete</button>
                           </form>
                        </td>
                     </tr>
               @endforeach
            </tbody>
            </table>
            {{-- fitur appends akan menambahkan parameter agar dapat digunakan searching dengan pagination --}}
            {{$categories->appends(compact('q'))->links()}}
         </div>
      </div>
   </div>
@endsection

@section('script')
$(document).ready(function(){

   $('.btnDelete').click(function(event){
      if (!confirm('Apakah kamu akan menghapusnya?'))
         event.preventDefault();
   });
});
@endsection