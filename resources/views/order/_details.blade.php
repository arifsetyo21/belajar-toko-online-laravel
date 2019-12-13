<table class="table table-hover">
   <thead>
      <tr>
         <th scope="col">Produk</th>
         <th scope="col">Jumlah</th>
         <th scope="col">Harga</th>
      </tr>
   </thead>
   <tbody>
      @foreach ($order->details as $detail)
      <tr>
         <td data-th="Produk" scope="row">{{$detail->product->name}}</td>
         <td data-th="Jumlah" class="text-center">{{$detail->quantity}}</td>
         <td data-th="Harga" class="text-right">{{number_format($detail->price)}}</td>
      </tr>
      <tr>
         <td data-th="Subtotal">Subtotal</td>
         <td data-th="Subtotal" class="text-right" colspan="2">{{number_format($detail->price * $detail->quantity)}}</td>
      </tr>
      @endforeach
   </tbody>
   <tfoot>
      <tr>
         <td data-th="Subtotal"><strong>Ongkos Kirim</strong></td>
         <td data-th="Subtotal" class="text-right" colspan="2"><strong>Rp {{number_format($order->total_fee)}}</strong></td>
      </tr>
      <tr>
         <td data-th="Subtotal"><strong>Total</strong></td>
         <td data-th="Subtotal" class="text-right" colspan="2"><strong>Rp {{number_format($order->total_payment)}}</strong></td>
      </tr>
   </tfoot>
</table>