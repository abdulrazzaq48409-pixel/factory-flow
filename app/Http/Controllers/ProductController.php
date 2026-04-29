<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    private function checkProductsAccess()
    {
        if (!session('admin_logged_in')) {
            return redirect('/login');
        }

        if (session('staff_role') == 'Sales') {
            return redirect('/orders');
        }

        return null;
    }

    public function index()
    {
        if ($redirect = $this->checkProductsAccess()) return $redirect;

        $products = Product::latest()->get();

        $lowStockCount = Product::whereColumn('stock', '<=', 'low_stock_alert')->count();

        $totalProducts = Product::count();

        return view('products.index', compact(
            'products',
            'lowStockCount',
            'totalProducts'
        ));
    }

    public function create()
    {
        if ($redirect = $this->checkProductsAccess()) return $redirect;

        return view('products.create');
    }

    public function store(Request $request)
    {
        if ($redirect = $this->checkProductsAccess()) return $redirect;

        Product::create($request->all());

        return redirect('/products')->with('success', 'Product Added Successfully');
    }

    public function edit($id)
    {
        if ($redirect = $this->checkProductsAccess()) return $redirect;

        $product = Product::findOrFail($id);

        return view('products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        if ($redirect = $this->checkProductsAccess()) return $redirect;

        $product = Product::findOrFail($id);
        $product->update($request->all());

        return redirect('/products')->with('success', 'Product Updated Successfully');
    }

    public function destroy($id)
    {
        if ($redirect = $this->checkProductsAccess()) return $redirect;

        Product::findOrFail($id)->delete();

        return redirect('/products')->with('success', 'Product Deleted Successfully');
    }
}