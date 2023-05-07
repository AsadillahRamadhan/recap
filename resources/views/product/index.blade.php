@extends('layouts.main')
@section('content')
<div id="add" class="justify-content-end d-flex">
    <a class="btn btn-primary mb-3" href="/product/create">Add Product</a>
</div>
<div class="row">
    @foreach($products as $product)
    <div class="col-md-3">
        <div class="card" style="width: 16.3rem;">
            <img class="rounded" src="https://source.unsplash.com/260x170/?handphone" class="card-img-top" alt="...">
            <div class="card-body">
              <h6 class="text-gray"><small class="text-end">{{ date('d F Y', strtotime($product->tanggal_pembelian)); }}</small></h6>
              <h5 class="card-title">{{ $product->nama }}</h5><br>
              <h6 class="text-gray"><small class="text-end">{{ $product->spesifikasi }}</small></h6>
              <p class="card-text">{{ $product->deskripsi }}</p>
              <p class="card-text">{{ "Rp. " . number_format($product->harga_beli,2,",",".") }}</p>
              <form id="form" method="POST" action="{{ url('/product/'.$product->id) }}" class="d-flex justify-content-center">
                @csrf
                @method('DELETE')
                <button type="button" id="terjual" class="btn btn-primary text-white mr-1"><i class="fa-solid fa-sack-dollar"></i></button>
                <a href="{{ "product/" . $product->id }}" class="btn btn-warning text-white mr-1"><i class="fa-solid fa-eye"></i></a>
                <a href="{{ "product/" . $product->id . "/edit" }}" class="btn btn-success text-white mr-1"><i class="fa-solid fa-pen-to-square"></i></a>
                <button onclick="konfirmasiForm()" type="submit" class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
              </form>
              <form action="{{ '/product/' . $product->id . '/terjual'}}" id="terjuals" method="post">
                @csrf
                <input type="hidden" name="harga_jual" id="hargaJualInput">
                <input type="hidden" name="tanggal_penjualan" id="tanggalPenjualanInput">
              </form>
            </div>
          </div>
    </div>
    @endforeach
@endsection
@push('custom_js')
<script>
function konfirmasiForm() {
  event.preventDefault();
  Swal.fire({
    title: 'Apakah Anda yakin?',
    text: 'Data akan dihapus. Apakah Anda ingin melanjutkan?',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Ya, kirimkan!',
    cancelButtonText: 'Batal'
  }).then((result) => {
    if (result.isConfirmed) {
      document.getElementById('form').submit(); 
    }
  });
}

$('#terjual').click(function(){
  Swal.fire({
            title: 'Masukkan Harga Terjual',
            input: 'number',
            inputPlaceholder: 'Masukkan Harga',
            showCancelButton: true,
                inputAttributes: {
                    maxlength: 255,
                    autocapitalize: 'off',
                    autocorrect: 'off'
                }
        }).then((result) => {
        if (result.isConfirmed) {
            document.querySelector("#hargaJualInput").value = result.value
            Swal.fire({
                title: 'Masukkan Tanggal terjual',
                inputPlaceholder: 'Masukkan Tanggal',
                showCancelButton: true,
                html: '<input type="date" class="input-group" id="tanggalPenjualanInputs">',
            }).then((result) => {
            if (result.isConfirmed) {
                const temp = document.querySelector('#tanggalPenjualanInputs').value
                const date = new Date(temp);
                document.querySelector("#tanggalPenjualanInput").value = temp
                document.querySelector('#terjuals').submit()
                
            }
            });
        }
    });

    
})
</script>
@endpush