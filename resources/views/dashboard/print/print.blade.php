@extends('dashboard.layouts.main')
@section('title', 'Export')
@section('container')
    <div class="d-flex justify-content-center flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 style="text-transform: uppercase;">CETAK LAPORAN</h1>
    </div>
    <div class="mb-3">
        <a id="export" href="/print/excel?start={{ $start_date }}&&end={{ $end_date }}" class="btn btn-primary">Print
            EXCEL</a>
        <a href="/dashboard/print   " class="btn btn-success"><i class="bi bi-caret-left-fill"></i> Kembali</a>
    </div>
    <div class="table-responsive">
        <table class="table" id="example">
            <thead>
                <tr>
                    <th scope="col">Tanggal Muat</th>
                    <th scope="col">FO</th>
                    <th scope="col">FU</th>
                    <th scope="col">Driver</th>
                    <th scope="col">Jenis Armada</th>
                    <th scope="col">Customer</th>
                    <th scope="col">Alamat Kirim</th>
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
                @if ($transaksis->isNotEmpty())
                    @foreach ($transaksis as $transaksi)
                        <tr>
                            <td>{{ $transaksi->tanggal_muat }}</td>
                            <td>{{ $transaksi->fo }}</td>
                            <td>{{ $transaksi->fu }}</td>
                            <td>{{ $transaksi->driver }}</td>
                            <td>{{ $transaksi->jenis_armada }}</td>
                            <td>{{ $transaksi->nama_customer }}</td>
                            <td>{{ $transaksi->alamat_kirim }}</td>
                            <td>Rp. {{ number_format($transaksi->ongkos_angkut, 0, ',', '.') }}</td>
                            <td>Rp. {{ number_format($transaksi->biaya_rcf, 0, ',', '.') }}</td>
                            <td>Rp. {{ number_format($transaksi->biaya_return, 0, ',', '.') }}</td>
                            <td>Rp. {{ number_format($transaksi->biaya_inap, 0, ',', '.') }}</td>
                            <td>Rp. {{ number_format($transaksi->multi_drop, 0, ',', '.') }}</td>
                            <td>Rp. {{ number_format($transaksi->tob, 0, ',', '.') }}</td>
                            <td>Rp. {{ number_format($transaksi->total_biaya, 0, ',', '.') }}</td>
                    @endforeach
                @else
                    <tr>
                        <td colspan="12" style="text-align: center; text-transform: uppercase;font-weight:bold">Belum ada
                            data laporan kspedisi pada tanggal yang dipilih</td>
                    </tr>
                @endif
                </tr>
            </tbody>
        </table>
    </div>


@endsection
