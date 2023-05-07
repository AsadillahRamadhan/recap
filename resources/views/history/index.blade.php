@extends('layouts.main')
@section('content')
<form action="/histories">
    <h5 class="text-gray">Filters</h5>
    <div class="d-flex">
        <div class="mr-2">
            <p><small>Tanggal Awal</small></p>
            <input type="date" name="start_date" value="{{ isset($start_date)? $start_date : '' }}">
        </div>
        <div>
            <p><small>Tanggal Akhir</small></p>
            <input type="date" name="end_date" value="{{ isset($end_date)? $end_date : '' }}">
            <button class="btn btn-primary ml-2 text-middle" style="height: 31px">Kirim</button>
        </div>
        
    </div>
</form>
<div>
    <h5 class="text-gray mt-4">History Data</h5>
    <table class="table table-striped mt-3">
        <thead>
            <td>Nama</td>
            <td>Harga Beli</td>
            <td>Biaya Reparasi</td>
            <td>Harga Jual</td>
            <td>Tanggal Pembelian</td>
            <td>Tanggal Penjualan</td>
            <td class="text-center">Show Data</td>
        </thead>
        @if(count($histories) != null)
        @foreach($histories as $history)
        <tr>
            <td>{{ $history->nama }}</td>
            <td>{{ "Rp. " . number_format($history->harga_beli,2,".",",") }}</td>
            <td>{{ "Rp. " . number_format($history->biaya_reparasi,2,".",",") }}</td>
            <td>{{ "Rp. " . number_format($history->harga_jual,2,".",",") }}</td>
            <td>{{ date('d F Y', strtotime($history->tanggal_pembelian)); }}</td>
            <td>{{ date('d F Y', strtotime($history->tanggal_penjualan)); }}</td>
            <td class="d-flex justify-content-center"><a href="{{ "history/" . $history->id }}" class="btn btn-warning text-white mr-1"><i class="fa-solid fa-eye"></i></a></td>
        </tr>
        @endforeach
        <tr>
            <td colspan="2"><b>Total Pendapatan</b></td>
            <td><b>{{ "Rp. " . number_format($total,2,".",",") }}</b></td>
        </tr>
        @else
        <tr>
            <td colspan="7" class="text-center">Data Tidak Ditemukan!</td>
        </tr>
        @endif
    </table>
</div>
@endsection