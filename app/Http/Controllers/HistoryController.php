<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class HistoryController extends Controller
{
    public function index(Request $request){
        if(isset($request->start_date)){
            $histories = Product::whereBetween('tanggal_penjualan', [$request->start_date, $request->end_date])->whereNotNull('harga_jual')->get();
        } else {
            $histories = Product::whereNotNull('harga_jual')->get();
        }   
       

        $total_price = 0;
        foreach($histories as $history){
            if($history->is_sharing == 1){
                $total_price += (($history->harga_jual - $history->harga_beli - $history->biaya_reparasi) / 2);
            } else {
                $total_price += ($history->harga_jual - $history->harga_beli - $history->biaya_reparasi);
            }
        }

        if(isset($request->start_date)){
            return view('history.index', [
                'histories' => $histories,
                'total' => $total_price,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'title' => 'Product History',
                'active' => 'history'
            ]);
        } else {
            return view('history.index', [
                'histories' => $histories,
                'total' => $total_price,
                'title' => 'Product History',
                'active' => 'history'
            ]);
        }
        
    }

    public function show($id){
        $product = Product::find($id);
        return view('history.details', [
            'product' => $product,
            'title' => 'History Details',
            'active' => 'history'
        ]);
    }
}
