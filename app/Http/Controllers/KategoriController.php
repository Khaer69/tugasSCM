<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\Product;
use Exception;
use RealRashid\SweetAlert\Facades\Alert;

class KategoriController extends Controller
{
    public function index(){
        $kategoris = Kategori::all();
        return view('kategori.index', compact('kategoris'));
    }

    public function store(Request $request) {
        try{
            $request->validate([
                'nama' => 'required|string|max:255'
            ]);

            $data = [
                'nama' => $request->nama,
                'slug' => $request->nama,
                'created_at' => now()
            ];

        Kategori::create($data);
        Alert::success('succes', 'Kategori berhasil disimpan.');
            return redirect()->route('kategori.index');
           
        }catch(Exception $e) {
            return $e;
            return redirect()->back()->withInput()->withErrors(['message' => 'Terjadi kesalahan saat menyimpan data.']);
        }


    }

    public function edit(Request $request)
    {
        $id = $request->id;
        $data = Kategori::findOrFail($id);

        return response()->json($data, 200);
    }

    public function update(Request $request) {
        try{
            $request->validate([
                'nama' => 'required|string|max:255'
            ]);

            $data = [
                'nama' => $request->nama,
                'slug' => $request->nama,
                // 'created_at' => $request->created_at
            ];
            
           Kategori::where('id', $request->id)->update($data);
         

           Alert::success('success', 'Kategori berhasil diubah.');
            return redirect()->route('kategori.index');
           
          
        }catch(Exception $e) {
            return $e;
            return redirect()->back()->withInput()->withErrors(['message' => 'Terjadi kesalahan saat mengubah data.']);
        }
    }

    public function delete(Request $request) {
        $id = $request->id;
        Kategori::destroy($id);
        Alert::success('success', 'Kategori berhasil dihapus.');
        return redirect()->route('kategori.index');
    }
}
