<table class="table table-hover">
   <thead>
      <tr>
         <th scope="col">Produk</th>
         <th scope="col">Jumlah</th>
         <th scope="col">Harga</th>
      </tr>
   </thead>
   <tbody>
      @foreach ($cart->details() as $order)    
      <tr>
         <td data-th="Produk">{{$order['detail']['name']}}</td>
         <td data-th="Jumlah">{{$order['quantity']}}</td>
         <td data-th="Harga">{{number_format($order['detail']['price'])}}</td>
      </tr>
      <tr>
         <td data-th="Subtotal">Subtotal</td>
         <td data-th="Subtotal" class="text-right" colspan="2">Rp{{number_format($order['subtotal'])}}</td>
      </tr>
      @endforeach
   </tbody>
   <tfoot>
      @if (request()->is('checkout/payment'))
         <tr>
            <td data-th="Subtotal"><strong>Ongkos Kirim</strong></td>
            <td data-th="Subtotal" class="text-right" colspan="2"><strong>Rp{{number_format($cart->shippingFee())}}</strong></td>
         </tr>
         <tr>
            <td><strong>Total</strong></td>
            <td class="text-right" colspan="2">
               <strong>Rp{{number_format($cart->shippingFee() + $cart->totalPrice())}}</strong>
            </td>
         </tr>
      @else
         <tr>
            <td><strong>Total</strong></td>
            <td class="text-right" colspan="2"><strong>Rp{{number_format($cart->totalPrice())}}</strong></td>
         </tr>
      @endif
   </tfoot>
</table>
    