@extends('dashboard.layouts.main')
@vite(['resources/css/app.css', 'resources/js/app.js'])
@section('container')
    <div
        class="d-flex justify-content-center text-center flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 style="text-transform: uppercase;">UPDATE PROFIL</h1>
    </div>

    @if (session()->has('success'))
        <div class="alert alert-primary col-lg-4" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <form action="post" action="/profile/update" class="mt-6 space-y-6">
                        @csrf
                        @method('put')
                        <div>
                            <x-input-label for="Nama" :value="__('Nama')" />
                            <x-text-input id="driver" value="{{ Auth::user()->driver }}" name="driver" type="text"
                                class="mt-1 block w-full" />
                        </div>

                        <div>
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" value="{{ Auth::user()->email }}" name="email" type="email"
                                class="mt-1 block w-full" />
                        </div>

                        <div>
                            <x-input-label for="nomor_polisi" :value="__('Nomor Polisi')" />
                            <x-text-input id="nomor_polisi" value="{{ Auth::user()->nomor_polisi }}" name="nomor_polisi"
                                type="text" class="mt-1 block w-full" />
                        </div>

                        <div>
                            <x-input-label for="jenis_armada" :value="__('Jenis Armada')" />
                            <select class="mt-1 block w-full" name="jenis_armada" id="jenis_armada" data-tags="true">
                                <option value="">Pilih Jenis Armada</option>
                                @foreach ($armada as $item)
                                    <option value="{{ $item->jenis_armada }}">{{ $item->jenis_armada }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="password" class="form-label">Password</label>
                            <input type="password" id="password" name="password" class="form-control"
                                placeholder="Kosongkan Jika Tidak Ingin Ubah Password">
                        </div>

                        <div>
                            <label for="password" class="form-label">Konfirmasi Password</label>
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                class="form-control" placeholder="Kosongkan Jika Tidak Ingin Ubah Password">
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Konfirmasi</button>
                    </form>

                </div>
            </div>

        </div>
    </div>
@endsection
