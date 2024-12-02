<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Html\Editor\Fields\Select;

class DistribusiController extends Controller
{
    public function index(Request $request) {
        $dataProduct = DB::table('products')
                        ->leftJoin('users', 'products.users_id', 'users.id')
                        ->select('users.name as nameUsers', 'users.id', 'users.lokasi', 'users.kontak', 
                        'products.id', 'products.name as namaProduct', 'products.harga', 'products.image')
                        ->where('products.distribusi_id', auth()->user()->id)
                        ->get();
        return view('distributor.index', compact('dataProduct'));
    }
}
