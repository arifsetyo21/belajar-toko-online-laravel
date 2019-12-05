<form action="{{route('cart')}}" class="form-inline" method="post">
   @csrf
   <input type="hidden" name="product_id" value="{{$product->id}}">
   <div class="form-group">
     <input type="number"
       class="form-control" name="quantity" placeholder="Jumlah Order" min="1">
   </div>
   <button type="submit" class="btn btn-primary ml-2">Tambah ke cart</button>
</form>