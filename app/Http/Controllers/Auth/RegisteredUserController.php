<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // $request->validate([
        //     'name' => ['required', 'string', 'max:255'],
        //     'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
        //     'password' => ['required', 'confirmed', Rules\Password::defaults()],
        // ]);

        $validator = Validator::make($request->all(), [
            'pemilik_nama' => ['required', 'string', 'max:255'],
            'pemilik_jeniskelamin' => ['required', 'string', 'max:255'],
            'pemilik_tanggal_lahir' => ['required', 'date', 'before:today'],
            'pemilik_kontak' => ['required', 'string', 'unique:users,pemilik_kontak', 'min:12', 'max:13'],
            'pemilik_pendidikan' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed', Rules\Password::default()],
        ]);

        // $user = User::create([
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'password' => Hash::make($request->password),
        // ]);

        // event(new Registered($user));

        if ($validator->fails()) {
            return redirect()->route('register')
                ->withErrors($validator)
                ->withInput();
        }

        event(new Registered($user = User::create([
            'pemilik_nama' => $request->pemilik_nama,
            'pemilik_jeniskelamin' => $request->pemilik_jeniskelamin,
            'pemilik_tanggal_lahir' => $request->pemilik_tanggal_lahir,
            'pemilik_kontak' => $request->pemilik_kontak,
            'pemilik_pendidikan' => $request->pemilik_pendidikan,
            'password' => Hash::make($request->password),
        ])));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
