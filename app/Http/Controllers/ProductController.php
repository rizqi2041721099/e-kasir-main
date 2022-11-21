<?php

namespace App\Http\Controllers;

use App\Models\{Product,ProductCategory};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->get();
        
        return view('product.index', [
            'title' => 'Barang',
            'products'  => $products
        ]);
    }

    public function create()
    {
        return view('product.create', [
            'title' => 'Tambah Barang',
            'categories' => ProductCategory::all()
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'price' => ['required'],
            'name' => ['required'],
            'category_id' => ['required'],
            'image' => ['image', 'file', 'max:2048'],
            'stock'=> ['required'],
            'expired'=> ['required'],
        ], [
            'price.required' => 'Harga tidak boleh kosong.',
            'name.required' => 'Nama tidak boleh kosong.',
            'stock.required' => 'Stock tidak boleh kosong.',
            'expired.required' => 'Expired date tidak boleh kosong.',
            'category_id.required' => 'Kategori tidak boleh kosong.',
            'image.image' => 'File yang diupload harus berupa gambar.',
            'image.file' => 'File yang diupload harus berupa gambar.',
            'image.max' => 'Ukuran gambar tidak boleh lebih dari 2MB.'
        ]);
        if ($request->file('image')) {
            $fileName = 'e-kasir-' . time() . '.' . $request->file('image')->extension();
            Storage::putFileAs('products', $request->file('image'), $fileName);
            $validated['image'] = $fileName;
        }
        
        Product::create($validated);
        return response()->json(['alert' => 'Data berhasil disimpan!'], 200);
    }

    public function edit($id)
    {
        return view('product.edit', [
            'title' => 'Edit Produk',
            'product' => Product::findOrFail($id),
            'categories' => ProductCategory::all()
        ]);
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'price' => ['required', 'numeric'],
            'name' => ['required'],
            'category_id' => ['required'],
            'image' => ['image', 'file', 'max:2048'],
        ], [
            'price.required' => 'Harga tidak boleh kosong.',
            'price.numeric' => 'Harga harus berupa angka.',
            'name.required' => 'Nama tidak boleh kosong.',
            'category_id.required' => 'Kategori tidak boleh kosong.',
            'image.image' => 'File yang diupload harus berupa gambar.',
            'image.file' => 'File yang diupload harus berupa gambar.',
            'image.max' => 'Ukuran gambar tidak boleh lebih dari 2MB.'
        ]);
        if ($request->file('image')) {
            $fileName = 'e-kasir-' . time() . '.' . $request->file('image')->extension();
            Storage::putFileAs('products', $request->file('image'), $fileName);
            Storage::delete('products/' . $request->oldImage);
            $validated['image'] = $fileName;
        }
        Product::find($request->id)->update($validated);
        return response()->json(['alert' => 'Data berhasil diubah!'], 200);
    }

    public function delete($id)
    {
        if (Product::find($id)->image) {
            Storage::delete('products/' . Product::find($id)->image);
        }
        Product::destroy($id);
        return response()->json(['alert' => 'Data berhasil dihapus!'], 200);
    }
}
