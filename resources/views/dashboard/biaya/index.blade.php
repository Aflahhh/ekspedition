@extends('dashboard.layouts.main')
@section('title', 'Biaya')
@section('container')
    <div
        class="d-flex justify-content-center flex-wrap flex-md-nowrap align-items-center pt-2 pb-2 mb-3 border-bottom border-2">
        <h1 style="text-transform: uppercase;">Data Biaya Ekspedisi </h1>
    </div>

    @if (session()->has('success'))
        <div class="alert alert-primary col-lg-8" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-responsive mb-2">
        <table class="table table-responsive table-bordered">
            <thead class="table-light">
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Jenis Armada</th>
                    <th scope="col">Alamat Kirim</th>
                    <th scope="col">Ongkos Angkut </th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @if ($costs->isNotEmpty())
                    @foreach ($costs as $biaya)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $biaya->jenis_armada }}</td>
                            <td>{{ $biaya->alamat_kirim }}</td>
                            <td>{{ $biaya->ongkos_angkut }}</td>
                            <td style="text-align: center;" class="m-3">
                                <a href="/dashboard/biaya/{{ $biaya->id_biaya }}/edit" class="btn btn-primary"><i
                                        class="bi bi-pencil-square"></i></a>
                                <form class="d-inline"
                                    action="{{ route('delete.biaya', ['id_biaya' => $biaya->id_biaya]) }}" method="post">
                                    @method('delete')
                                    @csrf
                                    <button id="delete" class="btn btn-danger border-0"><i
                                            class="bi bi-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="6" class="text-center" style="text-transform: uppercase;font-weight:bold">Belum ada
                            data laporan ekspedisi</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>

    <div class="container-button">
        <button class="button-6" role="button" onclick="window.location.href='/dashboard/biaya/create'"
            style="color: #212529; border: 1px solid black; margin-bottom: 5px;">
            <i class="fa-solid fa-plus mx-1"></i> Tambah Biaya
        </button>
    @endsection
