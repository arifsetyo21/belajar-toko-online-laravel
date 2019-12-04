@extends('layouts.app')

@section('content')
    <div class="container">
       <div class="row">
          <div class="col-md-3">
             @include('catalog._category-panel')
          </div>
          <div class="col-md-9">
             <div class="row">
                <div class="col-md-12">
                  <nav aria-label="breadcrumb">
                     {{-- <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Kategori: Semua Product</a></li>
                     </ol> --}}
                     @include('catalog._breadcrumb', ['current_category' => isset($category) ? $category : null])
                  </nav>
                </div>
                @foreach ($products as $product)
                  <div class="col-md-6">
                     @include('catalog._product-thumbnail', ['product' => $product])
                  </div>
                @endforeach
                <div class="pull-right">
                   {{ $products->links() }}
                </div>
             </div>
          </div>
       </div>
    </div>
@endsection