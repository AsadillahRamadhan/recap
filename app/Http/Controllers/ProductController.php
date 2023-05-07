<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use PDO;

class ProductController extends Controller
{
    public function all(){
        $products = Product::whereNull('harga_jual')->get();
        return view('product.index', [
            'products' => $products,
            'title' => 'Products',
            'active' => 'product'
        ]);
    }

    public function create()
    {
        return view('product.form', [
            'url_form' => url('/product'),
            'title' => 'Add Product',
            'active' => 'product'
        ]);
    }

    public function store(Request $request)
    {
            
        $data = Product::create($request->except(['_token']));

        return redirect('products')
            ->with('success', 'Produk Berhasil Ditambahkan');
    }

    public function show(Product $product){
        return view('product.details', [
            'product' => $product,
            'title' => 'Product Details',
            'active' => 'product'
        ]);
    }

    public function edit($id){
        $product = Product::find($id);
        return view('product.form', [
            'product' => $product,
            'url_form' => url('/product/' . $id),
            'title' => 'Edit Product',
            'active' => 'product'
        ]);
    }

    public function update(Request $request, $id){

        $data = Product::where('id', '=', $id)->update($request->except(['_token', '_method']));
        return redirect('products')->with('success', 'Produk Berhasil Diedit');
    }

    public function destroy($id)
    {
        Product::where('id', '=', $id)->delete();
        return redirect('products')->with('success', 'Produk Berhasil Dihapus');
    }

    public function terjual(Request $request, $id){

    Product::where('id', '=', $id)->update([
        'harga_jual' => $request->harga_jual,
        'tanggal_penjualan' => $request->tanggal_penjualan
    ]);

       return redirect('products')->with('success', 'Produk Berhasil Terjual');
    }
}
