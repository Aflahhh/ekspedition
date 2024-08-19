<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Armada;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;
use App\Http\Requests\StoreArmadaRequest;
use App\Http\Requests\UpdateArmadaRequest;
use App\Models\Transaksi;

class ArmadaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $armada = Armada::all();
        return view("dashboard.armada.index", [
            'armadas' => $armada,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("dashboard.armada.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'nomor_polisi' => ['required', 'string', 'max:255'],
            'jenis_armada' => ['required', 'string'],
        ]);

        Armada::create($validatedData);

        return redirect('/dashboard/armada')->with('success', 'Berhasil Tambah Armada');
    }

    /**
     * Display the specified resource.
     */
    public function show(Armada $armada)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Armada $armada)
    {
        return view('dashboard.armada.edit', [
            'armada' => $armada,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Armada $armada)
    {
        $rules = [
            'nomor_polisi' => ['required', 'string', 'max:255'],
            'jenis_armada' => ['required', 'string'],
        ];

        $validatedData = $request->validate($rules);

        DB::transaction(function () use ($validatedData, $armada) {
            // Simpan nomor polisi lama untuk digunakan dalam pembaruan User
            $oldNomorPolisi = $armada->nomor_polisi;

            // Update Armada
            $armada->update($validatedData);

            // Update Users yang terkait dengan nomor polisi lama
            User::where('nomor_polisi', $oldNomorPolisi)->update([
                'nomor_polisi' => $validatedData['nomor_polisi'],
                'jenis_armada' => $validatedData['jenis_armada'],
            ]);

            Transaksi::where('nomor_polisi', $oldNomorPolisi)->update([
                'nomor_polisi' => $validatedData['nomor_polisi'],
                'jenis_armada' => $validatedData['jenis_armada'],
            ]);
        });

        return redirect('/dashboard/armada')->with('success', 'Berhasil Update Armada');
    }


    public function getArmadaByNomorPolisi($nomor_polisi)
    {
        $armada = Armada::where('nomor_polisi', $nomor_polisi)->first();

        if ($armada) {
            return response()->json([
                'jenis_armada' => $armada->jenis_armada,
            ]);
        }

        return response()->json([
            'jenis_armada' => null,
        ]);
    }


    /**
     * Remove the specified resource from storage.
     */
    // ArmadaController.php
    public function destroy($id_armada)
    {
        // Temukan armada berdasarkan ID
        $armada = Armada::findOrFail($id_armada);

        // Hapus semua pengguna yang terkait dengan armada ini
        $armada->users()->delete();

        // Hapus armada
        $armada->delete();

        return redirect('/dashboard/armada')->with('success', 'Berhasil Hapus');
    }
}
