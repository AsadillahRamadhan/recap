@extends('layouts.main')
@section('content')
<form action="{{ $url_form }}" method="post" id="formProduct">
    @csrf
    {!! (isset($product))? method_field('PUT') : '' !!}
<div class="row">
    <div class="col-md-3">
        <img src="https://source.unsplash.com/260x360/?handphone" alt="" class="rounded img-thumbnail">
    </div>
    <div class="col-md-9">
        <div class="d-flex"><h6 class="text-gray" id="storageTitle">{{ isset($product)? $product->spesifikasi : 'Ram dan Memori Internal' }}</h6><sup>&nbsp;&nbsp;<i class="fa-solid fa-pen-to-square" id="storage"></i></sup><input type="hidden" id="storageInput" name="spesifikasi" value="{{ isset($product)? $product->spesifikasi : old('spesifikasi') }}"></div>
        <div class="d-flex"><h1 class="mb-4" id="namaTitle">{{ isset($product)? $product->nama : 'Nama' }}</h1>&nbsp;<small><i class="fa-solid fa-pen-to-square" id="nama"></i></small><input type="hidden" id="namaInput" name="nama" value="{{ isset($product)? $product->nama : old('nama') }}"></div>
        <div class="mb-3">
            <div class="d-flex mb-2"><span>Deskripsi</span>&nbsp;<sup><i class="fa-solid fa-pen-to-square" id="desc"></i></sup><input type="hidden" id="descInput" name="deskripsi" value="{{ isset($product)? $product->deskripsi : old('deskripsi') }}"></div>
            <small id="descTitle">{{ isset($product)? $product->deskripsi : '' }}</small>
        </div>

        <div class="mb-3"><span class="mt-4" id="repairTitle">{{ isset($product)? 'Biaya Reparasi: Rp. ' . number_format($product->biaya_reparasi,2,",",".") : 'Biaya Reparasi' }}</span>&nbsp;<sup><i class="fa-solid fa-pen-to-square" id="repair"></i></sup><input type="hidden" id="repairInput" name="biaya_reparasi" value="{{ isset($product)? $product->biaya_reparasi : old('biaya_reparasi') }}"></div>
        
        <div class="mb-3"><span id="kelengkapanTitle">{{ isset($product)? 'Kelengkapan: ' . $product->kelengkapan : 'Kelengkapan' }}</span>&nbsp;<sup><i class="fa-solid fa-pen-to-square" id="kelengkapan"></i></sup><input type="hidden" id="kelengkapanInput" name="kelengkapan" value="{{ isset($product)? $product->kelengkapan : old('kelengkapan') }}"></div>
        <div class="mb-3"><span id="buyTitle">{{ isset($product)? 'Harga Beli: Rp. ' . number_format($product->harga_beli,2,",",".") : 'Harga Beli' }}</span>&nbsp;<sup><i class="fa-solid fa-pen-to-square" id="buy"></i></sup><input type="hidden" id="buyInput" name="harga_beli" value="{{ isset($product)? $product->harga_beli : old('harga_beli') }}"></div>
        <input type="hidden" id="isSharingInput" name="is_sharing">
        <div><span id="buyDateTitle">{{ isset($product)? 'Tanggal Pembelian: ' . date('d F Y', strtotime($product->tanggal_pembelian)) : 'Tanggal Pembelian' }}</span>&nbsp;<sup><i class="fa-solid fa-pen-to-square" id="buyDate"></i></sup><input type="hidden" id="buyDateInput" name="tanggal_pembelian" value="{{ isset($product)? $product->tanggal_pembelian : old('tanggal_pembelian') }}"></div>
        <div class="d-flex justify-content-end mt-3"><a href="/products" class="btn btn-success mr-1">Kembali</a><button type="submit" class="btn btn-primary">Kirim</button></div>
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
        let nama = ''
        if(document.querySelector('#namaInput').value != null){
            nama = document.querySelector('#namaInput').value
        } 
        Swal.fire({
            title: 'Add Product Name',
            input: 'text',
            inputPlaceholder: 'Add Product Name',
            inputValue: nama,
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
        let storage = ''
        if(document.querySelector('#storageInput').value != null){
            storage = document.querySelector('#storageInput').value
        }

Swal.fire({
    title: 'Add Product Storage',
    input: 'text',
    inputPlaceholder: 'Add Product Storage',
    inputValue: storage,
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
    let buy = ''
    if(document.querySelector('#buyInput').value != null){
            buy = document.querySelector('#buyInput').value
        } 

Swal.fire({
    title: 'Add Product Price',
    input: 'number',
    inputPlaceholder: 'Add Product Price',
    inputValue: buy,
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

    let kelengkapan = null
    if(document.querySelector('#kelengkapanInput').value != null){
            let temp = document.querySelector('#kelengkapanInput').value
            if(temp == 'Fullset'){
                kelengkapan = 1
            } else {
                kelengkapan = 0
            }
        }

    const inputOptions = ['Unit Only', 'Fullset']

    Swal.fire({
  title: 'Select Completeness',
  input: 'radio',
  showCancelButton: true,
  inputValue: kelengkapan,
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
    let repair = ''
    if(document.querySelector('#repairInput').value != null){
            repair = document.querySelector('#repairInput').value
        }

Swal.fire({
    title: 'Add Repair Price',
    input: 'number',
    inputPlaceholder: 'Add Repair Price',
    inputValue: repair,
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

    let desc = ''
    if(document.querySelector('#descInput').value != null){
            desc = document.querySelector('#descInput').value
        }

Swal.fire({
    title: 'Add Description',
    input: 'textarea',
    inputPlaceholder: 'Add Description',
    inputValue: desc,
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

let temps = 0;
//Tanggal pembelian
$('#buyDate').click(function() {
    let html = `<input type="date" class="input-group" id="inputDate" value="{{ isset($product)? $product->tanggal_pembelian : old('tanggal_pembelian') }}">`
    
    if(document.querySelector('#buyDateInput').value != null){
            buyDate = document.querySelector('#buyDateInput').value
        }

    if(temps > 0){
       html = `<input type="date" class="input-group" id="inputDate" value="` + buyDate + `">`
    }
Swal.fire({
    title: 'Add Buying Date',
    inputPlaceholder: 'Add Buying Date',
    showCancelButton: true,
    html: html,
}).then((result) => {
if (result.isConfirmed) {
    const temp = document.querySelector('#inputDate').value
    const date = new Date(temp);
    document.querySelector("#buyDateTitle").innerHTML = "Tanggal Pembelian: " + formatDate(date)
    document.querySelector("#buyDateInput").value = temp
    temps++
}
});
});

//Is Sharing
$('#formProduct').on('submit', function(){
    event.preventDefault()
    Swal.fire({
    title: 'Product Sharing',
    text: 'Apakah ini adalah Product Sharing?',
    icon: 'warning',
    showCancelButton: true,
    showDenyButton: true,
    confirmButtonText: 'Iya',
    denyButtonText: 'Tidak',
    cancelButtonText: 'Batal'
  }).then((result) => {
    if (result.isConfirmed) {
        document.querySelector('#isSharingInput').value = 1
        validator()
    } else if (result.isDenied){
        document.querySelector('#isSharingInput').value = 0
        validator()
    }
  });
})


function formatRupiah(angka) {
    var bilangan = parseInt(angka);

    if (isNaN(bilangan)) {
        return "";
    }

    var reverse = bilangan.toString().split("").reverse().join("");
    var ribuan = reverse.match(/\d{1,3}/g);
    var hasil = ribuan.join(".").split("").reverse().join("");

    return "Rp. " + hasil + ",00";
}

function formatDate(date) {
  const monthNames = [
    "January", "February", "March", "April", "May", "June", "July",
    "August", "September", "October", "November", "December"
  ];

  const day = date.getDate();
  const monthIndex = date.getMonth();
  const year = date.getFullYear();
    if(day > 9){
        return `${day} ${monthNames[monthIndex]} ${year}`;
    } else {
        return `${'0'+ day} ${monthNames[monthIndex]} ${year}`;
    }
  
}

function validator(){
    const num1 = (document.getElementById('namaInput')||{}).value||"";
    const num2 = (document.getElementById("storageInput")||{}).value||"";
    const num3 = (document.getElementById("buyInput")||{}).value||"";
    const num4 = (document.getElementById('kelengkapanInput')||{}).value||"";
    const num5 = (document.getElementById('repairInput')||{}).value||"";
    const num6 = (document.getElementById('descInput')||{}).value||"";
    const num7 = (document.getElementById("buyDateInput")||{}).value||"";
    const num8 = (document.getElementById("isSharingInput")||{}).value||"";

    if(num1 == "" || num2 == "" || num3 == "" || num4 == "" || num5 == "" || num6 == "" || num7 == "" || num8 == ""){
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Isi Semua Data Terlebih Dahulu!',
            })
        event.preventDefault();
    } else {
        document.querySelector("#formProduct").submit();
    }


}

</script>
@endpush
@endsection