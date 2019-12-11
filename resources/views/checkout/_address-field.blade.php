@csrf
<div class="form-group">
  <label for="name">Nama</label>
  <input type="text"
    class="form-control" name="name" id="name" aria-describedby="helpId" placeholder="">
  <small id="helpId" class="form-text text-muted">Help text</small>
</div>
<div class="form-group">
  <label for="detail">Detail Alamat</label>
  <textarea class="form-control" name="detail" id="detail" rows="3"></textarea>
</div>
<div class="form-group">
  <label for="province_id">Province</label>
  <select class="form-control" name="province_id" id="province_id">
     @foreach (DB::table('provinces')->pluck('name', 'id') as $key => $province)   
         <option value="{{$key}}">{{$province}}</option>
     @endforeach
  </select>
</div>
<div class="form-group">
  <label for="regency_id">Kabupaten/Kota</label>
  <select class="form-control" name="regency_id[]" id="regency_id">
     @foreach (DB::table('regencies')->pluck('name', 'id') as $key => $regency)   
         <option value="{{$key}}">{{$regency}}</option>
     @endforeach
  </select>
</div>
<div class="form-group">
  <label for="phone">Phone</label>
  <input type="text" class="form-control col-md-6" name="phone" id="phone" placeholder="+62 81234567890">
  @if ($errors->has('phone'))  
    <small id="helpId" class="form-text text-muted">{{$errors->first('phone')}}</small>
  @endif
</div>

