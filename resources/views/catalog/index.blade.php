@extends('layouts.app')

@section('content')
    <div class="container">
       <div class="row">
          <div class="col-md-3">
             @include('catalog._search-panel', [
                'q' => isset($q) ? $q : null,
                'cat' => isset($cat) ? $cat : ''
             ])

             @include('catalog._category-panel')

             @if (isset($category) && $category->hasChild())
                @include('catalog._sub-category-panel', ['current_category' => $category])
             @endif

             @if (isset($category) && $category->hasParent())
                 @include('catalog._sub-category-panel', ['current_category' => $category->parent])
             @endif
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
                  <nav>
                     @isset($error)
                        @if ($error->has('quantity'))
                           <div class="alert alert-danger">
                              <button class="close" type="button" data-dismiss="alert" aria-hidden="true">&times;</button>
                              {{ $errors->first('quantity') }}
                           </div>
                        @endif
                     @endisset
                  </nav>
                </div>
               @forelse ($products as $product)
                  <div class="col-md-6">
                     @include('catalog._product-thumbnail', ['product' => $product])
                  </div>
               @empty
                  <div class="col-md-12 text-center">
                     @if (isset($q))
                        <h1>:(</h1>
                        <p>Produk yang kamu cari tidak ditemukan.</p>
                        @if (isset($category))
                           <p><a href="url('/catalogs?q=' . $q)">Cari disemua kategori <i class="fas fa-arrow-right"></i></a></p> 
                        @endif
                     @else
                        <h1>:|</h1>
                        <p><a href="#">Belum ada produk untuk kategori ini.</a></p>
                     @endif
                     <p><a href="{{url('/catalogs')}}">Lihat semua produk <i class="fa fa-arrow-right" aria-hidden="true"></i></a></p>
                  </div>
               @endforelse
                <div class="pull-right">
                   @isset($cat)
                     {{ $products->appends(compact('cat', 'q'))->links() }}
                   @else
                     {{$products->links()}}
                   @endisset
                </div>
             </div>
          </div>
       </div>
    </div>
@endsection