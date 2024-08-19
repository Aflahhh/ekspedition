@extends('dashboard.layouts.main')

@section('container')
    <div
        class="d-flex justify-content-center flex-wrap flex-md-nowrap align-items-center pt-2 pb-2 mb-3 border-bottom border-2">
        <h1 style="text-transform: uppercase;">Detail User</h1>
    </div>

    <div class="container">
        <div class="row my-3">
            <div class="col-lg-8">
            </div>
            <div class="mb-3">
                <a href="/dashboard/user" class="btn btn-success"><i class="bi bi-caret-left-fill"></i> Kembali</a>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Nama</th>
                        <th scope="col">Email</th>
                        <th scope="col">Nomor Polisi</th>
                        <th scope="col">Armada</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $user->driver }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->nomor_polisi }}</td>
                        <td>{{ $user->jenis_armada }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="mb-3 d-flex justify-content-center gap-2">
            <a href="/dashboard/user/{{ $user->id }}/edit" class="btn btn-warning"><i class="bi bi-pencil-square"></i>
                Edit</a>
            <form class="d-inline" action="/dashboard/user/{{ $user->id }}" method="post">
                @method('delete')
                @csrf
                <button type="submit" id="delete" class="btn btn-danger border-0"><i class="bi bi-trash"></i></button>
            </form>

        </div>
    </div>
@endsection
