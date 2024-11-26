<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index() 
    {
        $categories = Category::all();
        return view('pages.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('pages.categories.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            "name" => "required|unique:categories,name",
        ],[
            "name.required" => "Nama kategori harus diisi",
            "name.unique" => "Nama kategori sudah ada",
        ]);

        $category = new Category();
        $category->name = $request->input('name');
        $category->slug = str::slug($request->input('name'));
        $category->save();

        return redirect('/categories');
    }

    public function edit($id)
    {
        $category = Category::find($id);

        return view('pages.categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            "name" => "required|unique:categories,name",
        ],[
            "name.required" => "Nama kategori harus diisi",
            "name.unique" => "Nama kategori sudah ada",
        ]);

        $category = Category::find($id);
        $category->name = $request->input('name');
        $category->slug = str::slug($request->input('name'));
        $category->save();

        return redirect('/categories');
    }

    public function delete($id)
    {
        Category::where('id', $id)->delete();
        return redirect('/categories');
    }
}
