<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class PelangganController extends Controller
{
    public function index(Request $request) {
       $dis =   DB::table('products')
       ->leftJoin('users', 'products.distribusi_id', 'users.id')
       ->select('users.name as nameUsers', 'users.id', 'users.lokasi', 'users.kontak', 
       'products.id', 'products.name as namaProduct', 'products.harga', 'products.image')
       ->where('products.distribusi_id', '!=', NULL)
       ->get();
        return view('pelanggan.index', compact('dis'));
    }


    public function daftarBarang(Request $request) {
        $id = $request->id;
        $daftarBarang =     DB::table('products')
       ->leftJoin('users', 'products.users_id', 'users.id')
       ->select('users.name as nameUsers', 'users.id', 'users.lokasi', 'users.kontak', 
       'products.id', 'products.name as namaProduct', 'products.harga', 'products.image')
       ->where('products.distribusi_id', '=', $id)
       ->get();

       return $daftarBarang;


    }
}
