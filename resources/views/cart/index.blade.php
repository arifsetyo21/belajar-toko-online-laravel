@extends('layouts.app')

@section('content')
   <div class="container">
      <h1>Keranjang Belanja</h1>
       @if ($cart->isEmpty())
           <div class="text-center">
              <h1>:|</h1>
              <p>Cart kamu masih kosong.</p>
              <p><a href="{{url('/catalogs')}}">Lihat semua produk <i class="fa fa-arrow-right" aria-hidden="true"></i></a></p>
           </div>
       @else
           <table class="table cart table-hover table-condensed table-light">
              <thead>
                 <th scope="col" style="width: 50%">Produk</th>
                 <th scope="col" style="width: 10%">Harga</th>
                 <th scope="col" style="width: 8%">Jumlah</th>
                 <th scope="col" style="width: 22%" class="text-center">Subtotal</th>
                 <th scope="col" style="width: 10%"></th>
              </thead>
              <tbody>
                 @foreach ($cart->details() as $order)
                  <tr>
                     <td data-th="Produk">
                        <div class="row">
                           <div class="col-sm-2 hidden-xs"><img class="img-thumbnail" src="{{$order['detail']['photo_path']}}" alt="" srcset=""></div>
                           <div class="col-sm-10 p-2">
                              <h4 class="nomargin">{{ $order['detail']['name']}}</h4>
                           </div>
                        </div>
                     </td>
                     <td data-th="Harga">Rp{{ number_format($order['detail']['price']) }}</td>
                     <td data-th="Jumlah">
                        <form class="form-inline" action="{{route('cart.updateProduct', ['product_id' => $order['id']])}}" method="post">
                           <div class="form-group">
                              @csrf
                              <input type="hidden" name="_method" value="put">
                              <input type="number" class="form-control" name="quantity" value="{{$order['quantity']}}">
                              <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-refresh" aria-hidden="true"></i></button>
                           </div>
                        </form>
                     </td>
                     <td data-th="Subtotal" class="text-center">Rp{{ number_format($order['subtotal'] ) }}</td>
                     <td class="actions" data-th="">
                        <form action="{{route('cart.removeProduct', ['id' => $order['id']])}}" method="post">
                        <div class="form-group">
                           <label class="sr-only" for="inputName">Method</label>
                           <input type="hidden" name="_method" value="delete">
                           <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash fa-sm" aria-hidden="true"></i> Delete</button>
                        </div>
                        @csrf
                     </form>
                     </td>
                  </tr>
                 @endforeach
              </tbody>
              <tfoot>
                 <tr>
                    <td><a href="{{url('/catalogs')}}" class="btn btn-warning"><i class="fa fa-angle-left" aria-hidden="true"></i> Belanja Lagi</a></td>
                    <td colspan="2" class="hidden-xs"></td>
                    <td class="hidden-xs text-center"><strong>Total Rp{{number_format($cart->totalPrice())}}</strong></td>
                    <td><a href="{{url('/checkout/login')}}" class="btn btn-success btn-block">Pembayaran <i class="fa fa-angle-right" aria-hidden="true"></i></a></td>
                 </tr>
              </tfoot>
           </table>
       @endif
    </div>
@endsection