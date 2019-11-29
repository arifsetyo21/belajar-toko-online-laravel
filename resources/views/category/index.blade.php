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
                     class="form-control col-md-6" name="q" id="search-category" aria-describedby="helpId" placeholder="Type Category">
                  <small id="helpId" class="form-text text-muted">{{$errors->first('q')}}</small>
               </div>
               <button type="submit" class="btn btn-primary">Search</button>
            </form>
            <table class="table table-hover mt-3">
            <thead>
               <tr>
                  <td class="font-weight-bolder">Title</td>
                  <td class="font-weight-bolder">Parent</td>
               </tr>
            </thead>
            <tbody>
               @foreach ($categories as $category)
                     <tr>
                        <td>{{$category->title}}</td>
                        <td>{{$category->parent ? $category->parent->title : ''}}</td>
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