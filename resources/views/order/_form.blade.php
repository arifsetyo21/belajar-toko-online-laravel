@csrf
<div class="form-group">
   <div class="row">
      <div class="col-md-4 text-right">
         <label for="Order">Order</label>
      </div>
      <div class="col-md-6">
         #{{$order->padded_id}}
      </div>
   </div>
</div>
<div class="form-group">
   <div class="row">
      <div class="col-md-4 text-right">
         <label for="Customer">Customer</label>
      </div>
      <div class="col-md-6">
         {{$order->user->name}}
      </div>
   </div>
</div>
<div class="form-group">
   <div class="row">
      <div class="col-md-4 text-right">
         <label for="alamat">Alamat pengiriman</label>
      </div>
      <div class="col-md-6">
         <div>
            <strong>{{$order->address->name}}</strong><br>
            {{$order->address->detail}}<br>           
            {{$order->address->regency->name}}, {{$order->address->regency->province->name}}<br>           
            <abbr title="Phone">P:</abbr>+62 {{$order->address->phone}}<br>           
         </div>
      </div>
   </div>
</div>
<div class="form-group">
   <div class="row">
      <div class="col-md-4 text-right">
         <label for="detail">Detail</label>
      </div>
      <div class="col-md-6">
         @include('order._details', compact('order'))
      </div>
   </div>
</div>
<div class="form-group">
   <div class="row">
      <div class="col-md-4 text-right">
         <label class="control-label" for="detail">Status</label>
      </div>
      <div class="col-md-6">
         <select class="form-control" name="status">
            @foreach (App\Order::statusList() as $key => $s)
               <option value="{{$key}}">{{$s}}</option>
            @endforeach
         </select>
   </div>
</div>
<button type="submit" class="btn btn-primary">Simpan</button>