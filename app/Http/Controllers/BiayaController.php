<?php

namespace App\Http\Controllers;

use App\Models\Cost;
use App\Models\User;
use App\Models\Armada;
use App\Models\Customer;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class BiayaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $costs =  Cost::all();
        return view('dashboard.biaya.index', [
            'costs' => $costs,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customers = Customer::all();
        $armada = Armada::all();
        return view('dashboard.biaya.create', [
            'customers' => $customers,
            'armada' => $armada,

        ]);
    }


    public function getAlamatKirim(Request $request)
    {
        $user = auth()->user();

        if ($user->driver == 'aflah') {
            // Jika user adalah admin, ambil jenis_armada dari request
            $jenis_armada = $request->input('jenis_armada');
        } else {
            // Jika user adalah driver, ambil jenis_armada dari user yang sedang login
            $jenis_armada = $user->jenis_armada;
        }

        $alamat_kirim = Cost::where('jenis_armada', $jenis_armada)
            ->groupBy('alamat_kirim')
            ->get(['alamat_kirim']);

        return response()->json($alamat_kirim);
    }

    public function getOngkosAngkut(Request $request)
    {
        $user = auth()->user();
        $jenis_armada = $request->input('jenis_armada');
        $alamat_kirim = $request->input('alamat_kirim');

        // Jika user bukan admin, gunakan jenis_armada_login dan alamat_kirim_login
        if ($user->driver != 'aflah') {
            $jenis_armada = $request->input('jenis_armada') ?: $user->jenis_armada;
            $alamat_kirim = $request->input('alamat_kirim') ?: $user->alamat_kirim;
        }

        $ongkos_angkut = Cost::where('jenis_armada', $jenis_armada)
            ->where('alamat_kirim', $alamat_kirim)
            ->first();

        if (!$ongkos_angkut) {
            return response()->json(['ongkos_angkut' => 0]); // Handle if data not found
        }

        return response()->json(['ongkos_angkut' => $ongkos_angkut->ongkos_angkut]);
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data yang diterima dari request
        $validatedData = $request->validate([
            'jenis_armada' => ['required', 'string'],
            'alamat_kirim' => ['required', 'string'],
            'ongkos_angkut' => ['required', 'numeric'], // Menganggap ongkos_angkut harus berupa angka
        ]);

        // Mencari record Customer berdasarkan alamat_kirim
        $customer = Customer::where('alamat_kirim', $validatedData['alamat_kirim'])->first();

        // Jika Customer tidak ditemukan, tambahkan penanganan error
        if (!$customer) {
            return redirect()->back()->withErrors(['error' => 'Customer tidak ditemukan untuk alamat kirim tersebut.']);
        }

        // Mencari record Armada berdasarkan jenis_armada
        $armada = Armada::where('jenis_armada', $validatedData['jenis_armada'])->first();

        // Jika Armada tidak ditemukan, tambahkan penanganan error
        if (!$armada) {
            return redirect()->back()->withErrors(['error' => 'Armada tidak ditemukan untuk jenis armada tersebut.']);
        }

        // Membuat record Cost baru dengan id_armada dan id_customer dari tabel Armada
        Cost::create([
            'jenis_armada' => $validatedData['jenis_armada'],
            'alamat_kirim' => $validatedData['alamat_kirim'],
            'ongkos_angkut' => $validatedData['ongkos_angkut'],
            'id_armada' => $armada->id_armada, // Menggunakan ID armada yang ditemukan
            'id_customer' => $customer->id_customer, // Menggunakan ID customer yang ditemukan
        ]);

        // Redirect kembali dengan pesan sukses
        return redirect('/dashboard/biaya')->with('success', 'Berhasil Tambah Biaya');
    }


    public function getIdBiaya(Request $request)
    {
        $jenis_armada = $request->input('jenis_armada');
        $alamat_kirim = $request->input('alamat_kirim');

        // Query untuk mencari id_biaya dari tabel Cost berdasarkan alamat_kirim dan jenis_armada
        $cost = Cost::where('jenis_armada', $jenis_armada)
            ->where('alamat_kirim', $alamat_kirim)
            ->first();

        if ($cost) {
            return response()->json(['id_biaya' => $cost->id_biaya]);
        } else {
            return response()->json(['id_biaya' => null]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cost $cost)
    {
        $customers = Customer::all();
        $armada = Armada::all();
        return view('dashboard.biaya.edit', [
            'cost' => $cost,
            'customers' => $customers,
            'armada' => $armada
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cost $cost)
    {
        $rules = [
            'jenis_armada' => ['required', 'string'],
            'alamat_kirim' => ['required', 'string', 'max:255'],
            'ongkos_angkut' => ['required'],
        ];

        $validatedData = $request->validate($rules);

        $cost->update($validatedData);

        $transaksis = Transaksi::where('id_biaya', $cost->id_biaya)->first();
        if ($transaksis) {
            $transaksis->update([
                'alamat_kirim' => $validatedData['alamat_kirim'],
                'ongkos_angkut' => $validatedData['ongkos_angkut']
            ]);
        }

        return redirect('/dashboard/biaya')->with('success', 'Sukses Update Biaya');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_biaya)
    {
        Cost::destroy($id_biaya);
        return redirect('/dashboard/biaya')->with('success', 'Sukses Hapus Biaya');
    }
}
