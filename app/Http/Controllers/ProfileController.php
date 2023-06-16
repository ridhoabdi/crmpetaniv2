<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    // public function edit(Request $request): View
    // {
    //     return view('profile.edit', [
    //         'user' => $request->user(),
    //     ]);
    // }

    public function index()
    {
        $user_id = auth()->user()->id;
        $users = DB::table('users')
            ->select('pemilik_nama', 'pemilik_jeniskelamin', 'pemilik_tanggal_lahir', 'pemilik_kontak', 'pemilik_pendidikan', 'pemilik_keterangan')
            ->where('users.id', $user_id)
            ->get();

        // return dd($users);
        return view('pages.profilpetani.viewprofilpetani', compact('users'));
    }

    // menampilkan data profil pada form edit
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return dd($user);
    }

    // update profil
    public function updateprofile(Request $request, $id)
    {

    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
