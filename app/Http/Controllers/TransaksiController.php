<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Cost;
use App\Models\User;
use App\Models\Armada;
use App\Models\Customer;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreTransaksiRequest;
use App\Http\Requests\UpdateTransaksiRequest;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {
        // Memulai query dari model Transaksi
        $query = Transaksi::query();

        // Jika ada permintaan pencarian
        if ($request->has('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('driver', 'like', "%$searchTerm%")->orWhere('alamat_kirim', 'like', "%$searchTerm%")->orWhere('nama_customer', 'like', "%$searchTerm%");
            });
        }

        // Mengambil hasil query
        $transaksis = $query->get();
        $searchTerm = '';

        // membaca smeua data tabel transaksis
        // $transaksis = Transaksi::all();
        // membaca jumlah armada
        $armada = Armada::all();
        $totalArmada = Armada::count('id_armada');
        // otomatis membaca user yang login saat ini
        $userId = auth()->id();
        $currentUser = Auth::user();
        $totalUser = User::where('driver', '<>', 'aflah')->count();
        // Mendapatkan tanggal saat ini
        $currentDate = Carbon::now();
        // Dapatkan nama bulan saat ini
        $currentMonthName = $currentDate->translatedFormat('F');

        // Mengambil bulan dan tahun saat ini
        $currentMonth = $currentDate->month;
        $currentYear = $currentDate->year;


        // Menghitung total biaya untuk bulan dan tahun saat ini

        // total semua biaya
        $AllCost = Transaksi::sum('ongkos_angkut');

        // pendapatan user
        $totalBiaya = Transaksi::where('user_id', $userId)
            ->sum('total_biaya') * 0.3;
        // jumlah transaksi user
        $userTransaksi = Transaksi::where('user_id', $userId)->count();

        //pendapatan admin
        $pendapatan = Transaksi::sum('total_biaya') * 0.7;

        $totalTransaksi = Transaksi::count('id');
        $nomor_polisi = $currentUser->nomor_polisi;

        $formattedTotal = "Rp. " . number_format($totalBiaya, 0, ',', '.');
        $formattedAll = "Rp. " . number_format($AllCost, 0, ',', '.');
        $formattedTotalBiaya = "Rp. " . number_format($pendapatan, 0, ',', '.');

        // Mengembalikan view 'dashboard.posts.index' dengan data 'transaksis'
        return view('dashboard.index', ['currentMonthName' => $currentMonthName, 'nomor_polisi' => $nomor_polisi], compact('transaksis', 'totalTransaksi', 'userTransaksi', 'totalArmada', 'totalUser', 'formattedAll', 'formattedTotal', 'formattedTotalBiaya'), ['transaksis' => $transaksis,]);
    }


    public function dashboard(Request $request)
    {


        $query = Transaksi::query();

        // // Jika ada permintaan pencarian
        if ($request->has('search')) {
            $query->where('driver', 'like', '%' . $request->search . '%')->orWhere('nama_customer', 'like', '%' . $request->search . '%');
        }

        $transaksis = $query->orderBy('fo', 'ASC')->get();
        $transaksiUser = Transaksi::where('user_id', auth()->user()->id)
            ->orderBy('fo', 'ASC')
            ->get();

        return view('dashboard.posts.index', [
            'transaksis' => $transaksis,
            'transaksiUser' => $transaksiUser

        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Transaksi $transaksi, Cost $cost, Customer $customer, Armada $armada)
    {
        $customer = Customer::all();
        $cost = Cost::all();
        $armada = Armada::all();
        $user = User::all();
        return view('dashboard.posts.create', compact('customer', 'armada'), [
            'transaksis' => $transaksi,
            'customer' => $customer,
            'cost' => $cost,
            'armada' => $armada,
            'user' => $user,

        ]);
    }




    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $user_id = Auth::id();

        // Validasi input dari formulir
        $validatedData = $request->validate([
            'tanggal_muat' => 'required',
            'fo' => 'required',
            'fu' => 'required',
            'nomor_polisi' => 'required|max:10',
            'driver' => 'required',
            'jenis_armada' => 'required|max:3',
            'nama_customer' => 'required',
            'ongkos_angkut' => 'required',
            'alamat_kirim' => 'required',
            'biaya_return' => 'required',
            'biaya_inap' => 'required',
            'multi_drop' => 'required',
            'tob' => 'required',
            'images.*' => 'required|image|file|max:1024',
            'total_biaya' => 'required',
            'user_id' => 'required',
            'id_biaya' => 'required'
        ]);

        // if ($request->hasFile('images')) {
        //     $gambar = $request->file('images');
        //     $extension = $gambar->getClientOriginalExtension();
        //     $gambarname = time() . '.' . $extension;

        //     $path =  'uploads/';
        //     $gambar->move($path, $gambarname);
        //     // Tambahkan nama file gambar ke data yang divalidasi
        //     $validatedData['images'] = $path . $gambarname;
        // }

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $gambar) {
                $extension = $gambar->getClientOriginalExtension();
                $gambarname = time() . '_' . uniqid() . '.' . $extension;

                $path = 'uploads/';
                $gambar->move($path, $gambarname);
                $imageNames[] = $path . $gambarname;
            }
            // Gabungkan nama-nama file gambar ke data yang divalidasi sebagai JSON
            $validatedData['images'] = json_encode($imageNames);
        }

        // Tambahkan ID pengguna ke dalam data yang divalidasi
        if (Auth::user("Aflah")) {
            $validatedData['user_id'] = $request->input('user_id'); // Ambil dari input form
        } else {
            $validatedData['user_id'] = $user_id; // Gunakan ID pengguna yang sedang login
        }

        // Buat entri transaksi baru menggunakan data yang divalidasi
        Transaksi::create($validatedData, [
            'images' => $gambarname,
        ]);

        // Redirect pengguna ke halaman posts dengan pesan sukses
        return redirect('/dashboard/posts')->with('success', 'Data Transaksi Berhasil Ditambahkan!');
    }

    public function getDriverDetails(Request $request)
    {
        $driver = $request->input('driver');
        $user = User::where('driver', $driver)->first();

        if ($user) {
            return response()->json([
                'nomor_polisi' => $user->nomor_polisi,
                'jenis_armada' => $user->jenis_armada,
                'user_id' => $user->id,
            ]);
        }

        return response()->json(['error' => 'Driver not found'], 404);
    }


    public function getAlamatKirim(Request $request)
    {
        $jenis_armada = $request->input('jenis_armada');
        $jenis_armada_login = $request->input('jenis_armada_login');
        $alamat_kirim = [];

        if ($jenis_armada) {
            $alamat_kirim = Cost::where('jenis_armada', $jenis_armada)
                ->distinct()
                ->get(['alamat_kirim']);
        } elseif ($jenis_armada_login) {
            $alamat_kirim = Cost::where('jenis_armada', $jenis_armada_login)
                ->distinct()
                ->get(['alamat_kirim']);
        }

        return response()->json($alamat_kirim);
    }


    /**
     * Display the specified resource.
     */
    public function show(Transaksi $transaksi)
    {
        return view('dashboard.posts.show', ['transaksi' => $transaksi]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaksi $transaksi)
    {
        $customer = Customer::all();
        $cost = Cost::all();
        $user = User::all();
        $armada = Armada::all();
        return view('dashboard.posts.edit', compact('customer'), [
            'transaksis' => $transaksi,
            'cost' => $cost,
            'armada' => $armada,
            'user' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaksi $transaksi)
    {
        $user_id = Auth::id();
        $rules = [
            'tanggal_muat' => 'required',
            'fo' => 'required',
            'fu' => 'required',
            'nomor_polisi' => 'required|max:10',
            'driver' => 'required',
            'jenis_armada' => 'required|max:3',
            'nama_customer' => 'required',
            'alamat_kirim' => 'required',
            'ongkos_angkut' => 'required',
            'biaya_return' => 'required',
            'biaya_inap' => 'required',
            'multi_drop' => 'required',
            'tob' => 'required',
            'images.*' => 'image|mimes:jpg,jpeg,png|max:2048',
            'total_biaya' => 'required',
            'user_id' => 'required',
            'id_biaya' => 'required'
        ];


        $validatedData = $request->validate($rules);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $gambar) {
                $extension = $gambar->getClientOriginalExtension();
                $gambarname = time() . '_' . uniqid() . '.' . $extension;

                $path = 'uploads/';
                $gambar->move($path, $gambarname);
                $imageNames[] = $path . $gambarname;
            }
            // Gabungkan nama-nama file gambar ke data yang divalidasi sebagai JSON
            $validatedData['images'] = json_encode($imageNames);
        }

        // Tambahkan ID pengguna ke dalam data yang divalidasi
        if (Auth::user("Aflah")) {
            $validatedData['user_id'] = $request->input('user_id'); // Ambil dari input form
        } else {
            $validatedData['user_id'] = $user_id; // Gunakan ID pengguna yang sedang login
        }

        Transaksi::where('id', $transaksi->id)
            ->update($validatedData);


        return redirect('/dashboard/posts')->with('success', 'Berhasil Ubah Data Laporan');
    }


    public function deleteSelected(Request $request)
    {
        $ids = $request->input('pilih');
        if ($ids) {
            try {
                Transaksi::destroy($ids);
                return redirect('/dashboard/posts')->with('success', 'Selected posts deleted successfully.');
            } catch (\Exception $e) {
                return redirect('/dashboard/posts')->with('error', 'Failed to delete selected posts. Please try again.');
            }
        }
        return redirect('/dashboard/posts')->with('error', 'No posts selected for deletion.');
    }

    public function deleteAll()
    {
        Transaksi::truncate();
        return redirect('/dashboard/posts')->with('success', 'Selected posts deleted successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

        Transaksi::destroy($id);
        return redirect('/dashboard/posts')->with('success', 'Berhasil Hapus');
    }
}
