<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Armada;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $armada = Armada::all();
        return view('auth.register', [
            'armada' => $armada
        ]);
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'driver' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'nomor_polisi' => ['required', 'string', 'max:255'],
            'jenis_armada' => ['required', 'string'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'id_armada' => ['required'],
        ]);

        $user = User::create([
            'driver' => $request->driver,
            'email' => $request->email,
            'jenis_armada' => $request->jenis_armada,
            'nomor_polisi' => $request->nomor_polisi,
            'password' => Hash::make($request->password),
            'id_armada' => $request->id_armada,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }

    public function getArmadaDetails(Request $request)
    {
        $nomorPolisi = $request->get('nomor_polisi');
        $armada = Armada::where('nomor_polisi', $nomorPolisi)->first();

        if ($armada) {
            return response()->json([
                'id_armada' => $armada->id_armada,
                'jenis_armada' => $armada->jenis_armada,
            ]);
        } else {
            return response()->json(null);
        }
    }
}
