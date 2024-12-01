<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Exception;

class UserController extends Controller
{
    public function index()
    {
        $user = User::get();
        $role = DB::table('roles')->get();
        return view('user.index', ['users' => $user, 'role' => $role]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,',
            'password' => 'required|string|min:8',
            'role' => 'required'
        ]);
        try {
            $data = new User();
            $data->name = $request->name;
            $data->email = $request->email;
            $data->password = bcrypt($request->password);
            $data->assignRole($request->role);
            $data->save();
            Alert::success('Success', 'Tambah User Berhasil');

            return redirect()->route('user.index');
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            Alert::error('Error', 'Tambah User Gagal');
            return redirect()->back();
        }
    }

    public function edit(Request $request)
    {
        $id = $request->id;
        $data = User::findOrFail($id);

        return response()->json($data, 200);
    }

    public function update(Request $request)
    {
        $id = $request->id;
        if ($request->password != null) {
            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password)
            ];
        } else {
            $data = [
                'name' => $request->name,
                'email' => $request->email
            ];
        }
        User::where('id', $id)->update($data);
        toast('Data Berhasil Di Update', 'success');
        return redirect()->back();
    }

    public function delete()
    {
        $id = request()->id;
        User::destroy($id);
        toast('Data Berhasil Dihapus', 'warning');
        return redirect()->back();
    }
}
