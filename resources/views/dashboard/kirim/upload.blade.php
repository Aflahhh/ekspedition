@extends('dashboard.layouts.main')
@section('title', 'Kirim File')
@section('container')
    @if (session('success'))
        <script>
            alert("{{ session('success') }}");
        </script>
    @endif

    <div
        class="d-flex justify-content-center flex-wrap mb-5 flex-md-nowrap align-items-center pt-2 pb-2 mb-3 border-bottom border-2">
        <h1 style="text-transform: uppercase;">kirim laporan</h1>
    </div>

    <div class="d-flex justify-content-center align-items-center">
        <form action="{{ route('send-email') }}" method="POST" enctype="multipart/form-data" style="width: 50%;">
            @csrf
            <div class="mb-3">
                <input type="file" name="file" class="form-control">
            </div>
            <div class="mb-3">
                <button id="kirim" type="submit" class="btn btn-primary">Upload</button>
            </div>
        </form>
    </div>
@endsection
