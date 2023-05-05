<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function all(){
        $products = Product::all();
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
}
