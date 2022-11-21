<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    public function index()
    {
        return view('product-category.index', [
            'title' => 'Kategori Produk',
            'categories' => ProductCategory::all()
        ]);
    }

    public function create()
    {
        return view('product-category.create', [
            'title' => 'Tambah Kategori'
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required']
        ], [
            'name.required' => 'Nama tidak boleh kosong.'
        ]);
        ProductCategory::create($validated);
        return response()->json(['alert' => 'Data berhasil disimpan!'], 200);
    }

    public function edit($id)
    {
        return view('product-category.edit', [
            'title' => 'Edit Kategori',
            'category' => ProductCategory::findOrFail($id)
        ]);
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required']
        ], [
            'name.required' => 'Nama tidak boleh kosong.'
        ]);
        ProductCategory::find($request->id)->update($validated);
        return response()->json(['alert' => 'Data berhasil diubah!'], 200);
    }

    public function delete($id)
    {
        ProductCategory::destroy($id);
        return response()->json(['alert' => 'Data berhasil dihapus!'], 200);
    }
}
