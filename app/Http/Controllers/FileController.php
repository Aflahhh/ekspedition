<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileController extends Controller
{
    public function index()
    {
        $this->authorize('IsAdmin');
        return view('dashboard.kirim.upload');
    }
    public function upload(Request $request)
    {
        // Validasi unggahan file disini jika diperlukan

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            // Lakukan apa yang ingin Anda lakukan dengan file yang diunggah di sini
            // Sebagai contoh, Anda bisa menyimpannya di storage atau melakukan operasi lainnya
            // Kemudian, kirim file tersebut ke halaman lain
            return view('dashboard.kirim.index')->with('file', $file)->with('success', 'File berhasil diunggah.');
        } else {
            // Jika tidak ada file yang diunggah, tampilkan pesan kesalahan
            return back()->with('error', 'No file uploaded.');
        }
    }
}
