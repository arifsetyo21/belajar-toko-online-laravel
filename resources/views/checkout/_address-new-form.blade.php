@if ($errors->any())
   <div class="alert alert-danger">
      <ul>
         @foreach ($errors->all() as $error)
               <li>{{ $error }}</li>
         @endforeach
      </ul>
   </div>
@endif
<form action="{{url('checkout/address')}}" method="post">
   @include('checkout._address-field')
   <button type="submit" class="btn btn-primary">Lanjut <i class="fa fa-arrow-right" aria-hidden="true"></i></button>
</form>