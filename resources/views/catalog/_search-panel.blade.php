<div class="card border-secondary mb-3">
      <div class="card-header">Lihat per kategori</div>
      <div class="card-body">
         <form action="{{route('catalogs.index')}}" method="get">
            <div class="form-group">
              <label for="">Apa yang kamu cari?</label>
              <input type="text"
                class="form-control" name="q" id="q" aria-describedby="helpId" value="{{$q}}" placeholder="barang yang kamu cari?">
              <small id="helpId" class="form-text text-muted">{{$errors->first('title')}}</small>
            </div>
            <div class="form-group">
               <label class="sr-only" for="inputName">Category</label>
               <input type="hidden" value="{{$cat}}" class="form-control" name="cat">
            </div>
            <button type="submit" class="btn btn-primary">Cari</button>
         </form>
      </div>
   </div>