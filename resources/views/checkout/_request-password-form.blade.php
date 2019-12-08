<form action="{{url('/password/email')}}" method="post">
   @csrf
   <div class="form-group">
      <label for="email">Email</label>
      <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelpId" placeholder="example@mail.com" value="{{session()->has('email') ? session('email') : ''}}">
      <p>Nampaknya anda pernah berbelanja di Reselia. klik "Kirim Petunjuk" untuk meminta password baru.</p>
      <small id="emailHelpId" class="form-text text-muted">Help text</small>
   </div>
   <button type="submit" class="btn btn-primary">Kirim Petunjuk</button>

</form>