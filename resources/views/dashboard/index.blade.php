@extends('dashboard.layouts.main')


<style>
    .kartu-dashboard {
        display: flex;
        flex-wrap: wrap;
        /* Mengizinkan kartu untuk terlipat ke baris baru */
    }

    /* Menentukan lebar setiap kartu */
    .kartu-dashboard .col-xl-3 {
        flex: 0 0 50%;
        /* Setiap kartu memiliki lebar 50% saat ditampilkan samping 2 */
    }

    /* Menjalankan 4 kartu dalam satu baris pada layar yang lebih besar */
    @media (min-width: 992px) {
        .kartu-dashboard .col-xl-3 {
            flex: 0 0 25%;
            /* Setiap kartu memiliki lebar 25% saat ditampilkan dalam 4 kolom */
        }
    }

    .card-body {
        background-color: #ffc107;
        border-radius: 10px;
    }

    .isi-card,
    span {
        color: #2d2d2d;
    }


    .data {
        font-size: 5vw;
    }

    .fa-solid .fas {
        font-size: 1px;
    }
</style>

@section('container')
    @if (session()->has('success'))
        <div class="alert alert-primary col-lg-8" role="alert">
            {{ session('success') }}
        </div>
    @endif

    @if (in_array(auth()->user()->driver, ['aflah', 'mitra', 'sulistiawan']))

        <div
            class="d-flex justify-content-center flex-wrap flex-md-nowrap align-items-center pt-2 pb-2 mb-3 border-bottom border-2">
            <h1 style="text-transform: uppercase;">Dashboard </h1>
        </div>
        <div class="container-kartu">
            <div class="row mb-3 kartu-dashboard">
                <!-- Kartu 1: Total Transaksi -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="isi-card col mr-2">
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        {{ $totalTransaksi }}
                                    </div>
                                    <div class="text-xs text-capitalize mt-1">
                                        Pengiriman
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fa-solid fa-truck-fast fa-3x" style="color: #2d2d2d;"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if (auth()->user()->driver == 'aflah')
                    <!-- Kartu 2: Total User -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="isi-card col mr-2">
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            {{ $totalUser }}
                                        </div>
                                        <div class="text-xs text-capitalize mt-1">
                                            Driver
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fa-solid fa-user-tie fa-3x" style="color: #2d2d2d;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Kartu 3: Total Armada -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="isi-card col mr-2">
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            {{ $totalArmada }}
                                        </div>
                                        <div class="text-xs text-capitalize mt-1">
                                            Armada
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fa-solid fa-truck fa-3x" style="color: #2d2d2d;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="isi-card col mr-2">
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        {{ $formattedTotalBiaya }}
                                    </div>
                                    <div class="text-xs text-capitalize mt-1">
                                        Ongkos Angkut
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fa-solid fa-dollar-sign fa-3x" style="color: #2d2d2d;"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @can('IsMitra')
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="isi-card col mr-2">
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            {{ $formattedAll }}
                                        </div>
                                        <div class="text-xs text-capitalize mt-1">
                                            Ongkos
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fa-solid fa-dollar-sign fa-3x" style="color: #2d2d2d;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endcan
                <!-- Kartu 4: Total Biaya -->
            </div>
        </div>
        <div class="mb-3">
            <form action="{{ url('/dashboard') }}" method="GET">
                <div class="input-group mb-3">
                    <input name="search" type="text" class="form-control" placeholder="Search Driver"
                        value="{{ request('search') }}">
                    <button class="btn btn-warning" type="submit">Search</button>
                </div>
            </form>
        </div>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Tanggal Muat</th>
                        <th scope="col">Driver</th>
                        <th scope="col">FO</th>
                        <th scope="col">FU</th>
                        <th scope="col">Customer</th>
                        <th scope="col">Alamat Kirim</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($transaksis->isNotEmpty())
                        @foreach ($transaksis as $transaksi)
                            <tr style="text-transform: capitalize;">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $transaksi->tanggal_muat }}</td>
                                <td>{{ $transaksi->driver }}</td>
                                <td>{{ $transaksi->fo }}</td>
                                <td>{{ $transaksi->fu }}</td>
                                <td>{{ $transaksi->nama_customer }}</td>
                                <td>{{ $transaksi->alamat_kirim }}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6" class="text-center" style="text-transform: uppercase;font-weight:bold">Belum
                                ada
                                data
                                laporan kspedisi</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    @else
        <div
            class="d-flex justify-content-center flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom border-2">
            <h1 style="text-transform: uppercase">DASHBOARD</h1>
        </div>
        <div class="row mb-3">
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="isi-card col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">Nama</div>
                                <div style="text-transform: uppercase" class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ auth()->user()->driver }}</div>
                                <div class="mt-2 mb-0 text-muted text-xs">
                                    <span class=" mr-2"><i class="fa fa-arrow-up"></i></span>
                                    <span>Driver</span>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-5 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="isi-card col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">Nomor Polisi</div>
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $nomor_polisi }}</div>
                                <div class="mt-2 mb-0 text-muted text-xs">
                                    <span class=" mr-2"><i class="fas fa-arrow-up"></i> Saat ini</span>
                                    <span></span>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-users fa-2x text-info"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Earnings (Annual) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="isi-card col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">Transaksi</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $userTransaksi }}</div>
                                <div class="mt-2 mb-0 text-muted text-xs">
                                    <span class=" mr-2"><i class="fas fa-arrow-up"></i> Bulan</span>
                                    <span>{{ $currentMonthName }}</span>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-shopping-cart fa-2x "></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- New User Card Example -->
            <div class="col-xl-3 col-md-5 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="isi-card col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">Pendapatan</div>
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $formattedTotal }}
                                </div>
                                <div class="mt-2 mb-0 text-muted text-xs">
                                    <span class=" mr-2"><i class="fas fa-arrow-up"></i> Bulan</span>
                                    <span>{{ $currentMonthName }}</span>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-users fa-2x text-info"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/dashboard.css') }}">
@endsection
