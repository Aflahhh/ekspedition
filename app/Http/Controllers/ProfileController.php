<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Armada;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rules\Password;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Transaksi;

class ProfileController extends Controller
{

    public function index()
    {
        $user = Auth::user();
        $armada = Armada::all();
        $transaksis = Transaksi::all();
        return view('profile.index', [
            'users' => $user,
            'transaksis' => $transaksis,
            'armada' => $armada
        ]);
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $armada = Armada::all();
        $user = User::all();
        return view('profile.edit', [
            'user' => $user,
            'armada' => $armada
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request, User $user): RedirectResponse
    {

        $user = Auth::user();

        $rules = [
            'driver' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'nomor_polisi' => ['required', 'string', 'max:255'],
            'jenis_armada' => ['required', 'string'],
            'password' => ['nullable', 'confirmed', Password::defaults()],
            'id_armada' => ['required'],
        ];

        $validatedData = $request->validate($rules);

        $userData = [
            'driver' => $validatedData['driver'],
            'email' => $validatedData['email'],
            'nomor_polisi' => $validatedData['nomor_polisi'],
            'jenis_armada' => $validatedData['jenis_armada'],
            'id_armada' => $request->id_armada,
        ];

        if (!empty($validatedData['password'])) {
            $validatedData['password'] = Hash::make($validatedData['password']);
        } else {
            unset($validatedData['password']);
        }

        // Update user data
        \App\Models\User::where('id', $user->id)->update($userData);


        // Update armada data
        $armada = Armada::where('nomor_polisi', $validatedData['nomor_polisi'])->first();
        if ($armada) {
            $armada->update([
                'jenis_armada' => $validatedData['jenis_armada'],
            ]);
        }


        return redirect('/profile')->with('success', 'Berhasil Update User');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();


        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
