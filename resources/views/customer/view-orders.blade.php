@extends('layouts.app')

@section('content')
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <form action="{{url('home/orders')}}" method="get" class="mb-3">
               <div class="form-group form-inline">
                  <label for="q"></label>
                  <input type="text" class="form-control" name="q" id="q" aria-describedby="helpId" placeholder="">
               </div>
               <div class="form-group form-inline">
                  <label for="status"></label>
                  <select class="form-control " name="status" id="">
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
               <button type="submit" class="btn btn-primary">Cari</button>
            </form>
         <div class="col-md-12">
            <table class="table table-hover">
               <thead>
                  <tr>
                     <th scope="col">Order #</th>
                     <th scope="col">Tanggal Order</th>
                     <th scope="col">Status</th>
                     <th scope="col">Pembayaran</th>
                     <th scope="col">Detail</th>
                  </tr>
               </thead>
               <tbody>
                  @forelse ($orders as $order)
                  <tr>
                     <td scope="row">{{$order->padded_id}}</td>
                     <td>{{$order->created_at}}</td>
                     <td>{{$order->human_status}}</td>
                     <td>
                        Total: <strong>{{ number_format($order->total_payment) }} </strong><br>
                        Transfer ke : {{ config('bank-accounts')[$order->bank]['bank'] }} a.n {{ config('bank-accounts')[$order->bank]['name'] }} {{ config('bank-accounts')[$order->bank]['number'] }}<br>
                        Dari : {{ $order->sender }}
                     </td>
                     <td>@include('order._details', compact('order'))</td>
                  </tr>
                  @empty
                  <tr>
                     <td colspan="4">Tidak ada order yang ditemukan</td>
                  </tr>
                  @endforelse
               </tbody>
            </table>
         </div>
         {{$orders->appends(compact('q', 'status'))->links()}}
         </div>
      </div>
   </div>
@endsection