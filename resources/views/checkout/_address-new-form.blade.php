<form action="{{url('checkout/address')}}" method="post">
   @include('checkout._address-field')
   <button type="submit" class="btn btn-primary">Lanjut <i class="fa fa-arrow-right" aria-hidden="true"></i></button>
</form>