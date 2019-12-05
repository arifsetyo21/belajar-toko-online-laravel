<div class="card border-dark mb-3" style="max-width: 25rem;">
   <div class="card-header">Model : {{$product->model}}</div>
   <div class="card-body text-dark">
      <h5 class="card-title">{{$product->name}}</h5>
      <img src="{{$product->photo_path}}" class="img-rounded card-text" style="max-width: 100%;">
      <p>Category : 
         @foreach ($product->categories as $category)
            <span class="badge badge-primary">
               <i class="fas fa-tags"></i>
               {{$category->title}}
            </span>
         @endforeach
      </p>
      <p class="card-text">Harga : <strong>Rp. {{number_format($product->price, 2)}}</strong></p>
      {{-- Menampilkan partial view dengan mediator view untuk mempersingkat penulisan kode --}}
      @include('layouts._customer-feature', ['partial_view' => 'catalog._add-product-form', 'data' => compact($product)])
   </div>
</div>