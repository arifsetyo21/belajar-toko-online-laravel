<div class="card border-secondary mb-3">
      <div class="card-header">Subkategori untuk {{$current_category->title}}</div>
      <div class="card-body p-0">
         <div class="list-group list-group-flush">      
            @foreach ($current_category->childs as $category)
               <a href="{{url('/catalogs?cat=' . $category->id)}}" class="list-group-item">
                  {{$category->title}}
                  {!! ($category->total_products > 0) ? "<span class='badge badge-primary badge-pill float-right'>" . $category->total_products . "</span>" : '' !!}
               </a>
            @endforeach
         </div>
      </div>
   </div>