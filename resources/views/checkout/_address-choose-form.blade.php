<form action="{{url('checkout/address')}}" method="post">
   @csrf
   <div class="form-check">
      <label class="form-check-label">
         @foreach (Auth::user()->addresses as $address)   
            <input type="radio" class="form-check-input" name="address_id" value="{{$address->id}}">
            <strong>{{$address->name}}</strong><br>
            {{$address->detail}}<br>
            {{$address->regency->name}}<br>
            <abbr title="Phone">P:</abbr> +62 {{$address->phone}}<br>
            <br>
         @endforeach
            <input type="radio" class="form-check-input" name="address_id" value="new-address">
            <strong>Alamat Baru</strong>
            @include('checkout._address-field')
      </label>
      <button type="submit" class="btn btn-primary">Lanjut <i class="fa fa-arrow-right" aria-hidden="true"></i></button>
   </div>
</form>