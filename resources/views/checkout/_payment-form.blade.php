<form action="{{url('/checkout/payment')}}" method="post">
   @csrf
   <div class="form-group">
      <label for="bank_name">Pilih Bank yang Anda Gunakan</label>
      <select class="form-control" name="bank_name" id="bank_name">
         @foreach (bankList() as $account => $detail) 
            <option value="{{$account}}">{{$detail}}</option>
         @endforeach
      </select>
   </div>
   <div class="form-group">
   <label for="sender">Nama Pengirim</label>
   <input type="text"
      class="form-control" name="sender" id="sender" placeholder="Jhon Doe">
      @if ($errors->has('sender'))        
         <small id="helpId" class="form-text text-muted">Help text</small>
      @endif
   </div>
   <button type="submit" class="btn btn-primary"><i class="fa fa-lock" aria-hidden="true"></i> Konfirmasi Pesan</button>
</form>