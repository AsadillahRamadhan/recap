@extends('layouts.main')
@section('content')
<div id="add" class="justify-content-end d-flex">
    <a class="btn btn-primary mb-3" href="/product/create">Add Product</a>
</div>
<div class="row">
    @foreach($products as $product)
    <div class="col-md-3">
        <div class="card" style="width: 16.3rem;">
            <img src="..." class="card-img-top" alt="...">
            <div class="card-body">
              <h6 class="text-gray"><small class="text-end">{{ date('d F Y', strtotime($product->tanggal_pembelian)); }}</small></h6>
              <h5 class="card-title">{{ $product->nama }}</h5><br>
              <h6 class="text-gray"><small class="text-end">{{ $product->spesifikasi }}</small></h6>
              <p class="card-text">{{ $product->deskripsi }}</p>
              <p class="card-text">{{ "Rp. " . number_format($product->harga_beli,2,".",",") }}</p>
              <a href="{{ "product/" . $product->id }}" class="btn btn-primary">Show</a>
              <a href="{{ "product/" . $product->id . "/edit" }}" class="btn btn-primary">Edit</a>
            </div>
          </div>
    </div>
    @endforeach
@endsection