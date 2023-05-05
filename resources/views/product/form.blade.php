@extends('layouts.main')
@section('content')
<form action="{{ $url_form }}" method="post">
    @csrf
<div class="row">
    <div class="col-md-3">
        <img src="https://source.unsplash.com/260x360/?handphone" alt="" class="rounded img-thumbnail">
    </div>
    <div class="col-md-9">
        <div class="d-flex"><h6 class="text-gray" id="storageTitle">Ram dan Memori Internal </h6><sup>&nbsp;&nbsp;<i class="fa-solid fa-pen-to-square" id="storage"></i></sup><input type="hidden" id="storageInput" name="spesifikasi"></div>
        <div class="d-flex"><h1 class="mb-4" id="namaTitle">Nama</h1>&nbsp;<small><i class="fa-solid fa-pen-to-square" id="nama"></i></small><input type="hidden" id="namaInput" name="nama"></div>
        <div class="mb-3">
            <div class="d-flex mb-2"><span>Deskripsi</span>&nbsp;<sup><i class="fa-solid fa-pen-to-square" id="desc"></i></sup><input type="hidden" id="descInput" name="deskripsi"></div>
            <small id="descTitle"></small>
        </div>

        <div class="mb-3"><span class="mt-4" id="repairTitle">Biaya Reparasi</span>&nbsp;<sup><i class="fa-solid fa-pen-to-square" id="repair"></i></sup><input type="hidden" id="repairInput" name="biaya_reparasi"></div>
        
        <div class="mb-3"><span id="kelengkapanTitle">Kelengkapan</span>&nbsp;<sup><i class="fa-solid fa-pen-to-square" id="kelengkapan"></i></sup><input type="hidden" id="kelengkapanInput" name="kelengkapan"></div>
        <div class="mb-3"><span id="buyTitle">Harga Beli</span>&nbsp;<sup><i class="fa-solid fa-pen-to-square" id="buy"></i></sup><input type="hidden" id="buyInput" name="harga_beli"></div>
        <div><span id="buyDateTitle">Tanggal Pembelian</span>&nbsp;<sup><i class="fa-solid fa-pen-to-square" id="buyDate"></i></sup><input type="hidden" id="buyDateInput" name="tanggal_pembelian"></div>
        <div class="d-flex justify-content-end mt-3"><button type="submit" class="btn btn-secondary">Kirim</button></div>
    </div>
</div>
</form>
@push('custom_css')
<style>
    i{
        color: gray;
    }
    i:hover{
        color: #cfcece;
    }
</style>
@endpush
@push('custom_js')
<script>
    //Nama
    $('#nama').click(function() {

        Swal.fire({
            title: 'Add Product Name',
            input: 'text',
            inputPlaceholder: 'Add Product Name',
            showCancelButton: true,
                inputAttributes: {
                    maxlength: 255,
                    autocapitalize: 'off',
                    autocorrect: 'off'
                }
        }).then((result) => {
        if (result.isConfirmed) {
            document.querySelector("#namaTitle").innerHTML = result.value
            document.querySelector("#namaInput").value = result.value
            
        }
    });
    });

    //Ram dan Memori Internal
    $('#storage').click(function() {

Swal.fire({
    title: 'Add Product Storage',
    input: 'text',
    inputPlaceholder: 'Add Product Storage',
    showCancelButton: true,
        inputAttributes: {
            maxlength: 10,
            autocapitalize: 'off',
            autocorrect: 'off'
        }
}).then((result) => {
if (result.isConfirmed) {
    document.querySelector("#storageTitle").innerHTML = result.value
    document.querySelector("#storageInput").value = result.value
    
}
});
});

//Harga Beli
$('#buy').click(function() {

Swal.fire({
    title: 'Add Product Price',
    input: 'number',
    inputPlaceholder: 'Add Product Price',
    showCancelButton: true,
        inputAttributes: {
            maxlength: 255,
            autocapitalize: 'off',
            autocorrect: 'off'
        }
}).then((result) => {
if (result.isConfirmed) {
    document.querySelector("#buyTitle").innerHTML = "Harga Beli: " + formatRupiah(result.value)
    document.querySelector("#buyInput").value = result.value
    
}
});
});

//Kelengkapan
$('#kelengkapan').click(function(){

    const inputOptions = ['Unit Only', 'Fullset']

    Swal.fire({
  title: 'Select Completeness',
  input: 'radio',
  theme: 'dark',
  inputOptions: inputOptions,
  inputValidator: (value) => {
    if (!value) {
      return 'You need to choose something!'
    }
  }
}).then((result) => {
if (result.isConfirmed) {
    if(result.value == 0){
        result.value = 'Unit Only'
    } else {
        result.value = 'Fullset'
    }
    document.querySelector("#kelengkapanTitle").innerHTML = "Kelengkapan: " + result.value
    document.querySelector("#kelengkapanInput").value = result.value
    
}
});
});

//Reparasi
$('#repair').click(function() {

Swal.fire({
    title: 'Add Repair Price',
    input: 'number',
    inputPlaceholder: 'Add Repair Price',
    showCancelButton: true,
        inputAttributes: {
            maxlength: 255,
            autocapitalize: 'off',
            autocorrect: 'off'
        }
}).then((result) => {
if (result.isConfirmed) {
    document.querySelector("#repairTitle").innerHTML = "Biaya Reparasi: " + formatRupiah(result.value)
    document.querySelector("#repairInput").value = result.value
    
}
});
});

//deskripsi
$('#desc').click(function() {

Swal.fire({
    title: 'Add Description',
    input: 'textarea',
    inputPlaceholder: 'Add Description',
    showCancelButton: true,
        inputAttributes: {
            autocapitalize: 'off',
            autocorrect: 'off'
        }
}).then((result) => {
if (result.isConfirmed) {
    document.querySelector("#descTitle").innerHTML = result.value
    document.querySelector("#descInput").value = result.value
    
}
});
});

//Tanggal pembelian
$('#buyDate').click(function() {

Swal.fire({
    title: 'Add Buying Date',
    input: 'date',
    inputPlaceholder: 'Add Buying Date',
    showCancelButton: true,
    html: '<input type="date" class="input-group" id="inputDate">',
}).then((result) => {
if (result.isConfirmed) {
    const temp = document.querySelector('#inputDate').value
    const date = new Date(temp);
    document.querySelector("#buyDateTitle").innerHTML = "Tanggal Pembelian: " + formatDate(date)
    document.querySelector("#buyDateInput").value = temp
    
}
});
});


function formatRupiah(angka) {
    var bilangan = parseInt(angka);

    if (isNaN(bilangan)) {
        return "";
    }

    var reverse = bilangan.toString().split("").reverse().join("");
    var ribuan = reverse.match(/\d{1,3}/g);
    var hasil = ribuan.join(".").split("").reverse().join("");

    return "Rp. " + hasil;
}

function formatDate(date) {
  const monthNames = [
    "January", "February", "March", "April", "May", "June", "July",
    "August", "September", "October", "November", "December"
  ];

  const day = date.getDate();
  const monthIndex = date.getMonth();
  const year = date.getFullYear();

  return `${day} ${monthNames[monthIndex]} ${year}`;
}

</script>
@endpush
@endsection