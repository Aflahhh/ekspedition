@extends('dashboard.layouts.main')
@section('title', 'Export')
@section('container')
    <div
        class="d-flex justify-content-center flex-wrap flex-md-nowrap align-items-center pt-2 pb-2 mb-3 border-bottom border-2">
        <h1 style="text-transform: uppercase;">Cetak laporan</h1>
    </div>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Admin Page - Cetak Data</div>
                    <div class="card-body">
                        <form action="{{ route('print.data') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="start_date" class="form-label">Pilih Tanggal Mulai:</label>
                                <input type="date" id="start_date" name="start_date" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="end_date" class="form-label">Pilih Tanggal Akhir:</label>
                                <input type="date" id="end_date" name="end_date" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Cetak Data</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
