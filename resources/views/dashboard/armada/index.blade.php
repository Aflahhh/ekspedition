@extends('dashboard.layouts.main')

@section('title', 'Armada')

@section('container')
    <div
        class="d-flex justify-content-center flex-wrap flex-md-nowrap align-items-center pt-2 pb-2 mb-3 border-bottom border-2">
        <h1 style="text-transform: uppercase;">Data Armada </h1>
    </div>

    <a href="/dashboard/armada/create" class="btn btn-primary mb-3"><i class="bi bi-pencil-square"></i> Create New Post</a>

    <table class="table table-responsive table-bordered text-center">
        <thead class="table-light">
            <tr>
                <th scope="col">Kode</th>
                <th scope="col">Nomor Polisi</th>
                <th scope="col">Armada</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @if ($armadas->isNotEmpty())
                @foreach ($armadas as $armada)
                    <tr>
                        <td>{{ $armada->id_armada }}</td>
                        <td>{{ $armada->nomor_polisi }}</td>
                        <td>{{ $armada->jenis_armada }}</td>
                        <td style="text-align: center;" class="m-3">
                            <a href="/dashboard/armada/{{ $armada->id_armada }}/edit" class="btn btn-primary"><i
                                    class="bi bi-pencil-square"></i></a>
                            <form class="d-inline" action="/dashboard/armada/{{ $armada->id_armada }}" method="post">
                                @method('delete')
                                @csrf
                                <button id="delete" class="btn btn-danger border-0"><i class="bi bi-trash"></i></button>
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
@endsection
