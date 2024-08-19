@extends('dashboard.layouts.main')
@section('title', 'Csutomer')
@section('container')
    <div
        class="d-flex justify-content-center flex-wrap flex-md-nowrap align-items-center pt-2 pb-2 mb-3 border-bottom border-2">
        <h1 style="text-transform: uppercase;">Edit Data Customer</h1>
    </div>

    <div class="mb-3">
        <a href="/dashboard/customer" class="btn btn-success"><i class="bi bi-caret-left-fill"></i> Kembali</a>
    </div>

    <div class="container mt-4 mb-4 d-flex justify-content-center">
        <form method="POST" action="/dashboard/customer/{{ $customers->id_customer }}" style="width: 50%;">
            @csrf
            <div class="mb-3">
                <label for="nama_customer" class="form-label">Nama Customer</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fa-solid fa-arrow-up-9-1"></i></span>
                    <input type="text" id="nama_customer" class="form-control" name="nama_customer"
                        value="{{ $customers->nama_customer }}">
                </div>
                <x-input-error :messages="$errors->get('nama_customer')" class="mt-2" />
            </div>

            <div class="mb-3">
                <label for="alamat_kirim" class="form-label">Alamat Kirim</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fa-solid fa-location-dot"></i></span>
                    <input type="text" id="alamat_kirim" name="alamat_kirim" class="form-control"
                        value="{{ $customers->alamat_kirim }}">
                </div>
                <x-input-error :messages="$errors->get('alamat_kirim')" class="mt-2" />
            </div>

            <button type="submit" class="btn btn-primary w-100">Konfirmasi</button>
        </form>
    </div>
@endsection
