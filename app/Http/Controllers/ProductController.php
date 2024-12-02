<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Models\Product;
use Exception;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\File;
use App\Models\User;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('kategori')->get();
        $kategori = Kategori::all();
        $distributor = User::whereHas('roles', function ($query) {
            $query->where('id', 3); // Role ID 3
        })->get();
        return view('product.index', compact('products', 'kategori', 'distributor'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'deskripsi' => 'required|string',
                'image' => 'required|file|mimes:jpg,png,jpeg|max:4048',
                'kategori_id' => 'required',
                'distribusi_id' => 'required'
            ]);

            $gambar = $request->file('image');
            if ($gambar) {
                $namaGambar = time() . "_" . $gambar->getClientOriginalName();
                $gambar->move('uploads/products', $namaGambar);
            } else {
                $namaGambar =  Null;
            }

            $data = [
                'users_id' => auth()->user()->id,
                'name' => $request->name,
                'deskripsi' => $request->deskripsi,
                'image' => $namaGambar,
                'kategori_id' => $request->kategori_id,
                'harga' => $request->harga,
                'distribusi_id' => $request->distribusi_id,
                'quantity' => $request->quantity
            ];


            Product::create($data);
            Alert::success('success', 'Product berhasil ditambahkan.');
            return redirect()->route('product.index');
        } catch (Exception $e) {
            return back()->with('error', 'Gagal menyimpan data');
        }
    }

    public function edit(Request $request) {
        $id = $request->id;
        $data = Product::findOrFail($id);

        return response()->json($data, 200);
    }

    public function update(Request $request) {
        try{
            $request->validate([
                'name' => 'required|string|max:255',
                'deskripsi' => 'required|string',
                'kategori_id' => 'required'
            ]);

            $id = $request->id;

            $gambar = $request->file('image');
            if ($gambar) {
                $namaGambar = time() . "_" . $gambar->getClientOriginalName();
                $gambar->move('uploads/products', $namaGambar);
            } else {
                $gambarLama = Product::findOrFail($id)->value('image');
                $namaGambar =  $gambarLama;
            }

            $data = [
                'users_id' => auth()->user()->id,
                'name' => $request->name,
                'deskripsi' => $request->deskripsi,
                'image' => $namaGambar,
                'kategori_id' => $request->kategori_id,
                'harga' => $request->harga,
                'quantity' => $request->quantity,
                'distribusi_id' => $request->distribusi_id,
            ];


            Product::where('id', $id)->update($data);
            Alert::success('success', 'Product berhasil di Ubah.');
            return redirect()->route('product.index');

        }catch(Exception $e) {
          
            return redirect()->back()->withInput()->withErrors(['message' => 'Terjadi kesalahan saat menyimpan data.']);
        }
    }

    public function destroy(Request $request)
    {
        $id = $request->id;
        $data = Product::findOrFail($id);

        $imagePath = public_path('uploads/products/' . $data->image);
        if (File::exists($imagePath)) {
            File::delete($imagePath);
        }
        $data->delete();
        Alert::success('success', 'Data Berhasil Di Hapus');
        return redirect()->back();
    }
}
