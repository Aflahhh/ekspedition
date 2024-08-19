<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Armada;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Auth\Events\Registered;
use Illuminate\Validation\Rules\Unique;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rules\Password;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Validation\ValidationException;


class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('IsAdmin');
        return view('dashboard.print.index');
    }

    // fungsi print
    public function print(Request $request, Transaksi $transaksis)
    {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');

        $transaksis = Transaksi::whereBetween('tanggal_muat', [$start_date, $end_date])->get();

        return view('dashboard.print.print', compact('transaksis', 'start_date', 'end_date'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    // CONTROLLER HALAMAN USER
    public function userIndex()
    {
        $users = User::all();
        $armada = Armada::all();
        $driver = User::where('driver', '<>', 'aflah')->get();
        return view('dashboard.user.index', compact('driver'), [
            'users' => $users,
            'armadas' => $armada,

        ]);
    }

    public function createUser(Armada $armada)
    {
        $armada = Armada::all();
        return view('dashboard.user.create', [
            'armadas' => $armada
        ]);
    }

    public function storeUser(Request $request): RedirectResponse
    {
        try {
            $validatedData = $request->validate([
                'driver' => ['required', 'unique:users,driver,NOT NULL,id', 'string', 'max:255'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
                'nomor_polisi' => ['required', 'string', 'max:255'],
                'jenis_armada' => ['required', 'string'],
                'password' => ['required', 'confirmed', Password::defaults()],
            ]);

            // Cari armada berdasarkan nomor polisi
            $armada = Armada::where('nomor_polisi', $validatedData['nomor_polisi'])->first();

            // Jika armada belum ada di tabel, tambahkan ke tabel Armada
            if (!$armada) {
                $armada = Armada::create([
                    'nomor_polisi' => $validatedData['nomor_polisi'],
                    'jenis_armada' => $validatedData['jenis_armada'],
                ]);
            }

            // Buat pengguna baru dan asosiasikan dengan armada yang telah ditemukan atau dibuat
            $user = User::create([
                'driver' => $validatedData['driver'],
                'email' => $validatedData['email'],
                'jenis_armada' => $validatedData['jenis_armada'],
                'nomor_polisi' => $validatedData['nomor_polisi'],
                'id_armada' => $armada->id_armada, // Menggunakan ID armada yang ditemukan atau dibuat
                'password' => Hash::make($validatedData['password']),
            ]);

            event(new Registered($user));

            return redirect('/dashboard/user')->with('success', 'Berhasil Tambah User');
        } catch (ValidationException $e) {
            return Redirect::back()->withErrors($e->errors())->withInput();
        }
    }

    public function editUser(User $user, Armada $armada)
    {
        $nama = User::where('driver', "sulistiawan")->first();
        $armada = Armada::all();
        return view('dashboard.user.edit', [
            'user' => $user,
            'armadas' => $armada,
            'user' => $user,
            'nama' => $nama
        ]);
    }


    public function updateUser(Request $request, User $user)
    {
        try {
            $rules = [
                'driver' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email,' . $user->id],
                'nomor_polisi' => ['required', 'string', 'max:255'],
                'jenis_armada' => ['required', 'string'],
                'password' => ['nullable', 'confirmed', Password::defaults()],
            ];

            $validatedData = $request->validate($rules);

            if (!empty($validatedData['password'])) {
                $validatedData['password'] = Hash::make($validatedData['password']);
            } else {
                unset($validatedData['password']);
            }

            // Update user
            $user->update($validatedData);

            Log::info('User updated: ', ['user' => $user]);

            //update data transaksi
            $transaksis = Transaksi::where('user_id', $user->id);
            if ($transaksis) {
                $transaksis->update([
                    'driver' => $validatedData['driver'],
                    'jenis_armada' => $validatedData['jenis_armada']
                ]);
            }

            Log::info('Trasnasaksi updated: ', ['transaksis' => $transaksis]);


            return redirect('/dashboard/user')->with('success', 'Berhasil Update User');
        } catch (ValidationException $e) {
            return Redirect::back()->withErrors($e->errors())->withInput();
        }
    }

    public function showUser($id)
    {
        $user = User::findOrFail($id);

        try {
            $passwordDecrypt = Crypt::decryptString($user->password);
            $dataku = 12345;

            return view('dashboard.user.show', [
                'user' => $user,
                'dekripsi' => $dataku,   // Pastikan nama variabel sama
                'passwordDecrypt' => $passwordDecrypt
            ]);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            // Tangani pengecualian jika dekripsi gagal
            return back()->with('error', 'Decryption failed: ' . $e->getMessage());
        }
    }


    public function destroyUser($id)
    {

        // Cari pengguna berdasarkan ID yang diberikan
        $user = User::find($id);

        // Jika pengguna tidak ditemukan, kembalikan dengan pesan kesalahan
        if (!$user) {
            return redirect('/dashboard/user')->with('error', 'Pengguna atau Armada tidak ditemukan');
        }

        // Hapus semua transaksi yang terkait dengan pengguna
        Transaksi::where('user_id', $user->id)->delete();

        // Hapus pengguna
        $user->delete();

        // Arahkan kembali ke halaman dashboard pengguna dengan pesan sukses
        return redirect('/dashboard/user')->with('success', 'Pengguna dan transaksi terkait telah dihapus');
    }
}
