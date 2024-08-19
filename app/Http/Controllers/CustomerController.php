<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Customer::query();

        // // Jika ada permintaan pencarian
        if ($request->has('search')) {
            $query->where('nama_customer', 'like', '%' . $request->search . '%');
        }

        // // Mengambil customer unik berdasarkan nama, diurutkan berdasarkan tanggal pembuatan terbaru
        $customers = $query->orderBy('created_at', 'desc')
            ->distinct('nama_customer')
            ->paginate(5);
        // $customers = Customer::all();

        return view('dashboard.customer.index', [
            'customers' => $customers,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Customer $customer)
    {
        return view('dashboard.customer.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_customer' => ['required', 'string'],
            'alamat_kirim' => ['required', 'string'],
        ]);
        Customer::create($validatedData);

        return redirect('/dashboard/customer')->with('success', 'Berhasil Tambah Customer');;
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        return view('dashboard.customer.edit', [
            'customers' => $customer,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        $rules = [
            'nama_customer' => ['required', 'string', 'max:255'],
            'alamat_kirim' => ['required', 'string'],
        ];

        $validatedData = $request->validate($rules);
        $customer->update($validatedData);

        return redirect('/dashboard/customer')->with('success', 'Berhasil Update Customer');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_customer)
    {
        // Cari customer berdasarkan id_customer
        $customer = Customer::find($id_customer);

        // Periksa apakah customer ditemukan
        if (!$customer) {
            return redirect('/dashboard/customer')->with('error', 'Customer tidak ditemukan');
        }

        // Lakukan penghapusan jika customer ditemukan
        $customer->delete();

        return redirect('/dashboard/customer')->with('success', 'Customer berhasil dihapus');
    }
}
