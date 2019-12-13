@extends('layouts.app')

@section('content')
   <div class="container">
      <div class="row">
         <div class="col-md-4 mb-3">
            <form action="" method="get">
               <div class="form-group form-inline">
                  <label for=""></label>
                  <input type="text"
                     class="form-control" name="q" id="keyword" placeholder="Order ID/Customer" value="{{old('q')}}">
                  {{-- <small id="helpId" class="form-text text-muted">Help text</small> --}}
               </div>
               <div class="form-group form-inline">
                  <label for=""></label>
                  <select class="form-control" name="status" id="">
                        <option value="">Semua status</option>
                     @foreach (App\Order::statusList() as $key => $s) 
                        @if ($status == $key)
                           <option value="{{$key}}" aria-checked="true" selected>{{$s}}</option>
                        @else
                           <option value="{{$key}}">{{$s}}</option>
                        @endif
                     @endforeach
                  </select>
               </div>
               <button type="submit" class="btn btn-primary">Cari <i class="fa fa-glass" aria-hidden="true"></i></button>
            </form>
         </div>
         <div class="col-md-12">
            <table class="table table-hover">
               <thead>
                  <tr>
                     <th scope="col">#Order</th>
                     <th scope="col">Customer</th>
                     <th scope="col">Status</th>
                     <th scope="col">Pembayaran</th>
                     <th scope="col">Update Terakhir</th>
                  </tr>
               </thead>
               <tbody>
                  @if($orders->isEmpty())
                     <tr class="text-center">
                        <td colspan="5">
                           <h1>:|</h1>
                           <p>Order kamu masih kosong.</p>
                        </td>
                     </tr>
                  @else
                     @foreach ($orders as $order)    
                        <tr>
                           <th scope="row"><a href="{{route('orders.edit', [ 'id' => $order->id])}}">{{$order->padded_id}}</a></th>
                           <td>{{$order->user->name}}</td>
                           <td>{{$order->human_status}}</td>
                           <td>
                              <abbr title="Total bayar">Total:</abbr> Rp.{{number_format($order->total_payment)}} <br>
                              <abbr title="Transfer ke">Tujuan:</abbr> {{config('bank-accounts')[$order->bank]['bank']}} <br>
                              <abbr title="Pengirim">Dari:</abbr> {{$order->sender}}
                           </td>
                           <td>{{$order->updated_at->format('d, M Y H:i')}}</td>
                        </tr>
                     @endforeach
                  @endif
               </tbody>
               <tfoot>
               </tfoot>
            </table>
            {{$orders->appends(compact('status', 'q'))->links()}}
         </div>
      </div>
   </div>
@endsection