@extends('layouts.main')
@section('content')
<div class="row">
    <div class="col-md-3">
        <img src="https://source.unsplash.com/260x360/?handphone" alt="" class="rounded img-thumbnail">
        <a href="/products" class="btn btn-primary mt-2">Kembali</a>
    </div>
    <div class="col-md-9">
        <div class="d-flex"><h6 class="text-gray" id="storageTitle">{{ $product->spesifikasi }}</h6></div>
        <div class="d-flex"><h1 class="mb-4" id="namaTitle">{{ $product->nama }}</h1></div>
        <div class="mb-3">
            <div class="d-flex mb-2"><span>Deskripsi:</span></div>
            <small id="descTitle">{{ $product->deskripsi }}</small>
        </div>

        <div class="mb-3"><span class="mt-4" id="repairTitle">Biaya Reparasi: {{ "Rp. " . number_format($product->biaya_reparasi,2,".",",") }}</span></div>
        
        <div class="mb-3"><span id="kelengkapanTitle">Kelengkapan: {{ $product->kelengkapan }}</span></div>
        <div class="mb-3"><span id="buyTitle">Harga Beli: {{ "Rp. " . number_format($product->harga_beli,2,".",",") }}</span></div>
        <div><span id="buyDateTitle">Tanggal Pembelian: {{ date('d F Y', strtotime($product->tanggal_pembelian)); }}</span></div>
    </div>
</div>
@endsection