<form action="{{route('checkout.postLogin')}}" method="post">
   @csrf
   <div class="form-group">
     <label for="email">Email</label>
     <input type="email" class="form-control" name="email" id="email" value="{{old('email')}}" placeholder="example@mail.com">
     <small id="emailHelpId" class="form-text text-muted">Help text</small>
   </div>
   <label class="custom-control custom-radio">
     <input type="radio" name="is_guest" value="1" aria-selected="true" class="form-check-input" {{ (old('is_guest') !== '0') ? 'checked' : '' }}>
     <span class="custom-control-indicator">Saya adalah pelanggan baru</span>
     <br>
     <input type="radio" name="is_guest" value="0" aria-selected="true" class="form-check-input" {{ (old('is_guest') == '0') ? 'checked' : '' }}>
     <span class="custom-control-indicator">Saya adalah pelanggan tetap</span>
   </label>
   <div class="form-group">
     <label for="password">Password</label>
     <input type="password" class="form-control" name="checkout_password" id="password" placeholder="*******">
     @if($errors->first('checkout_password') !== '')
         <small id="emailHelpId" class="form-text text-danger"><strong>{{$errors->first('checkout_password')}}</strong></small>
     @endif
     <small id="emailHelpId" class="form-text text-muted"><a href="{{url('/password/reset')}}">Lupa Kata Sandi?</a></small>
   </div>
   <button type="submit" class="btn btn-primary float-right">Lanjut <i class="fa fa-arrow-right" aria-hidden="true"></i></button>
</form>