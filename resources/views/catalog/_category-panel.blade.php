<div class="card border-secondary mb-3">
   <div class="card-header">Lihat per kategori</div>
   <div class="card-body p-0">
      <div class="list-group list-group-flush">
         <a href="catalogs" class="list-group-item">Semua produk <span class="badge badge-primary badge-pill float-right">{{App\Product::count()}}</span></a>
         @foreach (App\Category::noParent()->get() as $category)
            <a href="{{url('/catalogs?cat=' . $category->id)}}" class="list-group-item">
               {{$category->title}}
               {!! ($category->total_products > 0) ? "<span class='badge badge-primary badge-pill float-right'>" . $category->total_products . "</span>" : '' !!}
            </a>
         @endforeach
      </div>
   </div>
</div>