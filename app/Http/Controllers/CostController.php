<?php

namespace App\Http\Controllers;

use App\Models\Cost;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCostRequest;
use App\Http\Requests\UpdateCostRequest;

class CostController extends Controller
{

    public function getPrice(Request $request)
    {
        $jenis_armada = $request->input('jenis_armada');
        $alamat_kirim = $request->input('alamat_kirim');

        $price = Cost::where('jenis_armada', $jenis_armada)
            ->where('alamat_kirim', $alamat_kirim)
            ->value('ongkos_angkut');

        return response()->json(['price' => $price]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StoreCostRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Cost $cost)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cost $cost)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCostRequest $request, Cost $cost)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cost $cost)
    {
        //
    }
}
