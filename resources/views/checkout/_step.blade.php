<div class="card-header">
   <ul class="nav nav-pills card-header-pills">
      <li class="nav-item">
         <a class="nav-link {{Request::is('checkout/login') ? 'active' : 'disable'}}" href="{{url('checkout/login')}}">Login</a>
      </li>
      <li class="nav-item">
         <a class="nav-link {{Request::is('checkout/address') ? 'active' : 'disable'}}" href="{{url('checkout/address')}}">Alamat</a>
      </li>
      <li class="nav-item">
         <a class="nav-link {{Request::is('checkout/payment') ? 'active' : 'disable'}}" href="#">Pembayaran</a>
      </li>
   </ul>
</div>