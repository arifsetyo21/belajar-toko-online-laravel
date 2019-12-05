<script>
   $(document).ready(function (params) {
      Swal.fire({
         title: 'Sukses',
         icon: 'success',
         confirmButtonText: 'Konfirmasi pesanan',
         cancelButtonText: "Lanjutkan belanja",
         showCancelButton: true,
         confirmButtonColor: "#63BC81",
         html: "Berhasil menambahkan <strong>{{$product_name}}</strong> ke cart!",
      }).then((result) => {
         if (result.value) {
            window.location = '/cart';
         }
      });
   });
   
</script>