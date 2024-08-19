@extends('dashboard.layouts.main')
@section('title', 'Penerima')
@section('container')
    <div
        class="d-flex justify-content-center flex-wrap flex-md-nowrap align-items-center pt-2 pb-2 mb-3 border-bottom border-2">
        <h1 style="text-transform: uppercase;">Data Penerima </h1>
    </div>

    @if (session()->has('success'))
        <div class="alert alert-primary col-lg-8" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-3">
        <form action="/dashboard/customer" method="GET">
            <div class="input-group mb-3">
                <input name="search" type="text" class="form-control" placeholder="Search Penerima"
                    value="{{ request('search') }}">
                <button class="btn btn-warning" type="submit">Search</button>
            </div>
        </form>
    </div>

    <div class="table-responsive mb-2">
        <table class="table table-responsive table-bordered">
            <thead class="table-light">
                <tr>
                    <th scope="col">Kode</th>
                    <th scope="col">Nama Penerima</th>
                    <th scope="col">Alamat Kirim</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @if ($customers->isNotEmpty())
                    @foreach ($customers as $customer)
                        <tr>
                            <td>{{ $customer->id_customer }}</td>
                            <td>{{ $customer->nama_customer }}</td>
                            <td>{{ $customer->alamat_kirim }}</td>
                            <td style="text-align: center;" class="m-3">
                                <a href="/dashboard/customer/{{ $customer->id_customer }}/edit" class="btn btn-primary"><i
                                        class="bi bi-pencil-square"></i></a>
                                <form class="d-inline" action="{{ route('customer.destroy', $customer->id_customer) }}"
                                    method="post">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="btn btn-danger border-0"><i
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
        <div class="pagination justify-content-center">
            {{ $customers->links() }}
        </div>
    </div>

    <div class="container-button">
        <button class="button-6" role="button" onclick="window.location.href='/dashboard/customer/create'"
            style="color: #212529; border: 1px solid black; margin-bottom: 5px;">
            <i class="fa-solid fa-plus mx-1"></i> Tambah Penerima
        </button>
    @endsection
