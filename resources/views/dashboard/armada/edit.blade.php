@extends('dashboard.layouts.main')
@section('title', 'Armada')
@section('container')
    <div
        class="d-flex justify-content-center flex-wrap flex-md-nowrap align-items-center pt-2 pb-2 mb-3 border-bottom border-2">
        <h1 style="text-transform: uppercase;">Tambah Armada</h1>
    </div>

    <div class="mb-3">
        <a href="/dashboard/armada" class="btn btn-success"><i class="bi bi-caret-left-fill"></i> Kembali</a>
    </div>

    <div class="container mt-4 mb-4 d-flex justify-content-center">
        <form method="POST" action="/dashboard/armada/{{ $armada->id_armada }}" style="width: 50%;">
            @method('put')
            @csrf
            <div class="mb-3">
                <label for="nomor_polisi" class="form-label">Nomor Polisi Armada</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fa fa-truck"></i></span>
                    <input type="text" id="nomor_polisi" name="nomor_polisi" class="form-control"
                        value="{{ old('nomor_polisi', $armada->nomor_polisi) }}" required autofocus
                        placeholder="Nomor Polisi Armada">
                </div>
                <x-input-error :messages="$errors->get('nomor_polisi')" class="mt-2" />
            </div>

            <div class="mb-3">
                <label for="jenis_armada" class="form-label">Jenis Armada</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fa fa-info-circle"></i></span>
                    <select name="jenis_armada" id="jenis_armada" class="form-select">
                        <option value="">Pilih Jenis Armada</option>
                        <option value="TR" {{ old('jenis_armada', $armada->jenis_armada) == 'TR' ? 'selected' : '' }}>TR
                        </option>
                        <option value="E" {{ old('jenis_armada', $armada->jenis_armada) == 'E' ? 'selected' : '' }}>E
                        </option>
                        <option value="TBU" {{ old('jenis_armada', $armada->jenis_armada) == 'TBU' ? 'selected' : '' }}>
                            TBU
                        </option>
                        <option value="ME" {{ old('jenis_armada', $armada->jenis_armada) == 'ME' ? 'selected' : '' }}>ME
                        </option>
                        <option value="DE" {{ old('jenis_armada', $armada->jenis_armada) == 'DE' ? 'selected' : '' }}>DE
                        </option>
                    </select>
                </div>
                <x-input-error :messages="$errors->get('jenis_armada')" class="mt-2" />
            </div>

            <button type="submit" class="btn btn-primary w-100">Konfirmasi</button>
        </form>
    </div>
@endsection
