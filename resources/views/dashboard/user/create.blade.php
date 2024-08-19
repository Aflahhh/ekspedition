@extends('dashboard.layouts.main')

@section('container')
    <div
        class="d-flex justify-content-center flex-wrap flex-md-nowrap align-items-center pt-2 pb-2 mb-3 border-bottom border-2">
        <h1 style="text-transform: uppercase;">Tambah User</h1>
    </div>

    <div class="mb-3">
        <a href="/dashboard/user" class="btn btn-success"><i class="bi bi-caret-left-fill"></i> Kembali</a>
    </div>

    <div class="container mt-4 mb-4 d-flex justify-content-center">
        <form method="POST" action="{{ route('user.post') }}" style="width: 50%;">
            @csrf
            <div class="mb-3">
                <label for="driver" class="form-label">Nama</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                    <input type="text" id="driver" name="driver" class="form-control" value="{{ old('driver') }}"
                        required autofocus placeholder="Nama">
                </div>
                <x-input-error :messages="$errors->get('driver')" class="mt-2" />
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                    <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}"
                        required autofocus placeholder="Email">
                </div>
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="mb-3">
                <label for="nomor_polisi" class="form-label">Nomor Polisi Armada</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fa fa-truck"></i></span>
                    <select name="nomor_polisi" id="nomor_polisi" class="form-select">
                        <option value="">Pilih Nomor Polisi</option>
                        @foreach ($armadas as $armada)
                            <option value="{{ $armada->nomor_polisi }}">{{ $armada->nomor_polisi }}</option>
                        @endforeach
                    </select>
                </div>
                <x-input-error :messages="$errors->get('nomor_polisi')" class="mt-2" />
            </div>

            <div class="mb-3">
                <label for="jenis_armada" class="form-label">Jenis Armada</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fa fa-info-circle"></i></span>
                    <select name="jenis_armada" id="jenis_armada" class="form-select">
                        <option value="">Pilih Jenis Armada</option>
                        @foreach ($armadas as $armada)
                            <option value="{{ $armada->jenis_armada }}">{{ $armada->jenis_armada }}</option>
                        @endforeach
                    </select>
                </div>
                <x-input-error :messages="$errors->get('jenis_armada')" class="mt-2" />
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    <input type="password" id="password" name="password" class="form-control" required
                        placeholder="Password">
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control"
                        required placeholder="Confirm Password">
                </div>
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <button type="submit" class="btn btn-primary w-100">Konfirmasi</button>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const nomorPolisiSelect = document.getElementById('nomor_polisi');
            const jenisArmadaInput = document.getElementById('jenis_armada');

            nomorPolisiSelect.addEventListener('change', function() {
                const nomorPolisi = this.value;
                if (nomorPolisi) {
                    fetch(`/api/get-armada/${nomorPolisi}`)
                        .then(response => response.json())
                        .then(data => {
                            if (data.jenis_armada) {
                                jenisArmadaInput.value = data.jenis_armada;
                            } else {
                                jenisArmadaInput.value = '';
                            }
                        });
                } else {
                    jenisArmadaInput.value = '';
                }
            });
        });
    </script>
@endsection
