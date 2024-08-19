@extends('dashboard.layouts.main')

<style>
    .table-container {
        width: 100%;
        overflow-x: auto;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th,
    td {
        text-align: center;
        padding: 8px;
        border: 1px solid #ddd;
        white-space: nowrap;
    }

    th {
        background-color: #f2f2f2;
    }

    img {
        width: 40px;
        margin: 0 2px;

        .button-container {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-bottom: 20px;
        }

        .button-container a,
        .button-container button {
            display: inline-flex;
            align-items: center;
            padding: 10px 20px;
            font-size: 16px;
            text-decoration: none;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .button-container a {
            background-color: #ffc107;
            color: #fff;
        }

        .button-container a:hover {
            background-color: #e0a800;
        }

        .button-container button {
            background-color: #dc3545;
            color: #fff;
        }

        .button-container button:hover {
            background-color: #c82333;
        }

        .button-container i {
            margin-right: 5px;
        }
</style>

@section('container')
    <div class="container">
        <div class="row my-3">
            <div class="col-lg-8">
                <h2 style="text-transform: capitalize">Driver : {{ $transaksi->driver }}</h2>
            </div>
            <div class="mb-3">
                <a href="/dashboard/posts" class="btn btn-success"><i class="bi bi-caret-left-fill"></i> Back To My Post</a>
            </div>
        </div>

        <div class="table-container">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Tanggal Muat</th>
                        <th scope="col">FO</th>
                        <th scope="col">FU</th>
                        <th scope="col">Nomor Polisi</th>
                        <th scope="col">Jenis Armada</th>
                        <th scope="col">Nama Customer</th>
                        <th scope="col">Alamat Kirim</th>
                        <th scope="col">Bukti Surat jalan</th>
                        <th scope="col">Ongkos Angkut</th>
                        <th scope="col">Biaya RCF</th>
                        <th scope="col">Biaya Return</th>
                        <th scope="col">Biaya Inap</th>
                        <th scope="col">Multi Drop</th>
                        <th scope="col">TOB</th>
                        <th scope="col">Total Biaya</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $transaksi->tanggal_muat }}</td>
                        <td>{{ $transaksi->fo }}</td>
                        <td>{{ $transaksi->fu }}</td>
                        <td>{{ $transaksi->nomor_polisi }}</td>
                        <td>{{ $transaksi->jenis_armada }}</td>
                        <td>{{ $transaksi->nama_customer }}</td>
                        <td>{{ $transaksi->alamat_kirim }}</td>
                        <td class="d-flex">
                            @if ($transaksi->images)
                                @foreach ($transaksi->images as $image)
                                    <img class="mx-2" src="{{ asset($image) }}" alt="Gambar" style="width: 70px;">
                                @endforeach
                            @endif
                            {{-- @if ($transaksi->images)
                                <img src="{{ asset($transaksi->images) }}" style="width: 35px; display:block"
                                    class="card-img-top col-sm-5">
                            @else
                                <p>No Image Available</p>
                            @endif --}}
                        </td>
                        <td>Rp. {{ number_format($transaksi->ongkos_angkut, 0, ',', '.') }}</td>
                        <td>Rp. {{ number_format($transaksi->biaya_rcf, 0, ',', '.') }}</td>
                        <td>Rp. {{ number_format($transaksi->biaya_return, 0, ',', '.') }}</td>
                        <td>Rp. {{ number_format($transaksi->biaya_inap, 0, ',', '.') }}</td>
                        <td>Rp. {{ number_format($transaksi->multi_drop, 0, ',', '.') }}</td>
                        <td>Rp. {{ number_format($transaksi->tob, 0, ',', '.') }}</td>
                        <td>Rp. {{ number_format($transaksi->total_biaya, 0, ',', '.') }}</td>
                    </tr>
                </tbody>
            </table>

            <div class="mb-3 d-flex justify-content-center gap-2">
                <div class="button-container">
                    <a href="/dashboard/posts/{{ $transaksi->id }}/edit" class="btn btn-warning">
                        <i class="bi bi-pencil-square"></i> Edit
                    </a>
                    <form class="d-inline" action="/dashboard/posts/{{ $transaksi->id }}" method="post">
                        @method('delete')
                        @csrf
                        <button type="submit" class="btn btn-danger">
                            <i class="bi bi-trash"></i> Delete
                        </button>
                    </form>
                </div>
            </div>

        </div>
    @endsection
