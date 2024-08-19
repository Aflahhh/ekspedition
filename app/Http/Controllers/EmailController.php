<?php

namespace App\Http\Controllers;

use App\Mail\SendEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\RedirectResponse;

class EmailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('IsAdmin');
        $pesan = "halo";
        $data = [
            'subject' => 'kirim',
            'sender_email' => 'aflahnabil01@gmail.com',
            'isi' => $pesan,
            'attachment' => null // Default value
        ];

        return view('dashboard.kirim.upload', [
            'pesan' => $pesan,
            'data' => $data,
        ])->with('success', 'File berhasil diunggah.');
    }

    // public function SendEmail()
    // {
    //     $pesan = 'halo bro';
    //     $data = [
    //         'subject' => 'kirim',
    //         'sender_email' => 'aflahnabil01@gmail.com',
    //         'isi' => $pesan,
    //         'attachment' => null // Default value
    //     ];
    //     Mail::to('pwira0567@gmail.com')->send(new SendEmail($data));;
    //     return 'halo';
    // }
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
        $request->validate([
            'file' => 'required|mimes:pdf,doc,xlsx,docx,txt|max:2048',
        ]);

        // Mendapatkan nama asli file
        $originalName = $request->file('file')->getClientOriginalName();

        // Menyimpan file ke storage dengan nama asli
        $path = $request->file('file')->storeAs('attachments', $originalName);

        // Data email yang akan dikirim
        $data = [
            'subject' => 'Kirim Email dengan Lampiran',
            'sender_email' => 'aflahnabil01@gmail.com',
            'isi' => $path,
            'attachment' => $path
        ];

        // Mengirim email dengan lampiran
        Mail::to('pwira0567@gmail.com')->send(new SendEmail($data));

        return view('dashboard.kirim.upload', [
            'data' => $data,
        ])->with('success', 'File berhasil diunggah.');
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
}
