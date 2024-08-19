@extends('dashboard.layouts.main')


@section('container')
    <style>
        th {
            border: 1px solid black;
        }

        .btn {
            margin: 0px 2px;
        }

        table {
            text-align: center;
            border: 1px solid black;
            text-transform: capitalize;
        }

        td {
            border: 1px solid black;
        }
    </style>
    <div class="d-flex justify-content-center flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 style="text-transform: uppercase;">DATA LAPORAN EKSPEDISI</h1>
    </div>

    @if (session()->has('success'))
        <div class="alert alert-primary col-lg-8" role="alert">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <a href="/dashboard/posts/create" class="btn btn-primary mb-3"><i class="bi bi-pencil-square"></i> Buat Data laporan </a>

    <div class="mb-3">
        <form action="/dashboard/posts" method="GET">
            <div class="input-group mb-3">
                <input name="search" type="text" class="form-control" placeholder="Cari Data Laporan"
                    value="{{ request('search') }}">
                <button class="btn btn-warning" type="submit">Search</button>
            </div>
        </form>
    </div>

    @if (in_array(auth()->user()->driver, ['aflah', 'mitra', 'sulistiawan']))


        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Tanggal Muat</th>
                    <th scope="col">Driver</th>
                    <th scope="col">FO</th>
                    <th scope="col">FU</th>
                    <th scope="col">Customer</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @if ($transaksis->isNotEmpty())
                    @foreach ($transaksis as $transaksi)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $transaksi->tanggal_muat }}</td>
                            <td>{{ $transaksi->driver }}</td>
                            <td>{{ $transaksi->fo }}</td>
                            <td>{{ $transaksi->fu }}</td>
                            <td>{{ $transaksi->nama_customer }}</td>
                            @if (auth()->user()->driver == 'aflah')
                                <td style="text-align: center;" class="m-3">

                                    <a href="/dashboard/posts/{{ $transaksi->id }}" class="btn btn-warning"><i
                                            class="bi bi-eye"></i></a>

                                    <a href="/dashboard/posts/{{ $transaksi->id }}/edit" class="btn btn-primary"><i
                                            class="bi bi-pencil-square"></i></a>

                                    <form class="d-inline" action="/dashboard/posts/{{ $transaksi->id }}" method="post">
                                        @method('delete')
                                        @csrf
                                        <button id="delete" class="btn btn-danger border-0"><i
                                                class="bi bi-trash"></i></i></button>
                                    </form>
                            @endif
                            @if (auth()->user()->driver == 'mitra' || auth()->user()->driver == 'sulistiawan')
                                <td style="text-align: center;" class="m-3">

                                    <a href="/dashboard/posts/{{ $transaksi->id }}" class="btn btn-warning"><i
                                            class="bi bi-eye"></i></a>
                            @endif
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="8" class="text-center" style="text-transform: uppercase;font-weight:bold">Belum ada
                            data laporan kspedisi</td>
                    </tr>
                @endif
            </tbody>
        </table>
    @else
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Tanggal Muat</th>
                    <th scope="col">FO</th>
                    <th scope="col">FU</th>
                    <th scope="col">Customer</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @if ($transaksiUser->isNotEmpty())
                    @foreach ($transaksiUser as $transaksiUser)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $transaksiUser->tanggal_muat }}</td>
                            <td>{{ $transaksiUser->fo }}</td>
                            <td>{{ $transaksiUser->fu }}</td>
                            <td>{{ $transaksiUser->nama_customer }}</td>
                            <td style="text-align: center;" class="m-3">

                                <a href="/dashboard/posts/{{ $transaksiUser->id }}" class="btn btn-warning"><i
                                        class="bi bi-eye"></i></a>

                                <a href="/dashboard/posts/{{ $transaksiUser->id }}/edit" class="btn btn-primary"><i
                                        class="bi bi-pencil-square"></i></a>

                                <form class="d-inline" action="/dashboard/posts/{{ $transaksiUser->id }}" method="post">
                                    @method('delete')
                                    @csrf
                                    <button id="delete" class="btn btn-danger border-0"><i
                                            class="bi bi-trash"></i></i></button>
                                </form>

                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="6" class="text-center" style="text-transform: uppercase;font-weight:bold">Belum ada
                            data
                            laporan kspedisi</td>
                    </tr>
                @endif
            </tbody>
        </table>
    @endif



@endsection
