<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Container\Attributes\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB as FacadesDB;
use Illuminate\Support\Facades\Redirect;

class ProductController extends Controller
{
    public function index() {
        $products = Product::with('category')->get();
        return view('pages.products.index', [
            "products" => $products,
        ]); 
    }

    public function create() {
        $Categories = Category::all();

        return view('pages.products.create',[
        "categories" => $Categories, 
        ]); 
    }

    public function store(Request $request) 
    {
        $validated = $request->validate([
            "name" => "required|string|max:255",
            "description" => "required|string",
            "price" => "required|numeric",
            "category_id" => "required|integer",
            "stock" => "required|integer",
            "sku" => "required|string|max:255",
        ]);

        Product::create($validated);

        return Redirect('/products');
    }
    public function edit($id)
    {
        $Categories = Category::all();
        $product = Product::findOrFail($id);

        return view('pages.products.edit',[
        "categories" => $Categories, 
        "product" => $product,
        ]); 
    }
    public function update(Request $request, $id) 
    {
        $validated = $request->validate([
            "name" => "required|string|max:255",
            "description" => "required|string",
            "price" => "required|numeric",
            "category_id" => "required|integer",
            "stock" => "required|integer",
            "sku" => "required|string|max:255",
        ]);

        Product::where('id', $id)->update($validated);

        return Redirect('/products');
    }

    public function delete($id) 
    {
        $product = Product::where('id',$id);
        $product->delete();

        return Redirect('/products'); 
    }
}
