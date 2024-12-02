<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $role = User::whereHas('roles', function ($query) {
            $query->where('id', 4); // Role ID 3
        })->first();
        return view('auth.register', compact('role'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // $user = User::create([
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'lokasi' => $request->lokasi,
        //     'kontak' => $request->kontak,
        //     'password' => Hash::make($request->password),
        // ]);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->lokasi = $request->lokasi;
        $user->kontak = $request->kontak;
        $user->password = bcrypt($request->password);
        $user->password = bcrypt($request->password_confirmation);
        $user->assignRole($request->role);
        $user->save();
        event(new Registered($user));
        Auth::login($user);

        // return redirect(RouteServiceProvider::HOME);
        return redirect('/login');
    }
}
