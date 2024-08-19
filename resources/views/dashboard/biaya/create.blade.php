@extends('dashboard.layouts.main')
@section('title', 'Biaya')
@section('container')
    <div
        class="d-flex justify-content-center flex-wrap flex-md-nowrap align-items-center pt-2 pb-2 mb-3 border-bottom border-2">
        <h1 style="text-transform: uppercase;">Tambah Data Biaya Ekspedisi</h1>
    </div>

    <div class="mb-3">
        <a href="/dashboard/biaya" class="btn btn-success"><i class="bi bi-caret-left-fill"></i> Kembali</a>
    </div>

    <div class="container mt-4 mb-4 d-flex justify-content-center">
        <form method="POST" action="{{ route('post.biaya') }}" style="width: 50%;">
            @csrf

            <div class="mb-3">
                <label for="jenis_armada" class="form-label">Jenis Armada</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fa fa-info-circle"></i></span>
                    <select name="jenis_armada" id="jenis_armada" class="form-select">
                        <option value="">Pilih Jenis Armada</option>
                        @foreach ($armada as $armada)
                            <option value="{{ $armada->jenis_armada }}">{{ $armada->jenis_armada }}</option>
                        @endforeach
                    </select>
                </div>
                <x-input-error :messages="$errors->get('jenis_armada')" class="mt-2" />
            </div>


            <div class="mb-3">
                <label for="alamat_kirim">Alamat Kirim</label>
                <div class="custom-select w-100">
                    <select class="alamat_kirim form-select" name="alamat_kirim" id="alamat_kirim">
                        <option value="">Pilih Alamat Kirim</option>
                        @if ($customers && $customers->count() > 0)
                            @foreach ($customers as $cust)
                                <option value="{{ $cust->alamat_kirim }}">{{ $cust->alamat_kirim }}</option>
                            @endforeach
                        @else
                            <option value="">No data available</option>
                        @endif
                    </select>
                    <input type="hidden" id="searchBox" class="search-box" placeholder="Cari...">
                </div>
                <x-input-error :messages="$errors->get('alamat_kirim')" class="mt-2" />
            </div>

            <div class="mb-3">
                <label for="ongkos_angkut" class="form-label">Biaya
                    Ekspedisi</label>
                <div class="input-group">
                    <span class="input-group-text">Rp.</span>
                    <input type="number" class="form-control" id="biaya_eksped
                        isi"
                        name="ongkos_angkut" value="{{ old('ongkos_angkut') }}">
                </div>
                <x-input-error :messages="$errors->get('ongkos_angkut')" class="mt-2" />
            </div>

            <button type="submit" class="btn btn-primary w-100">Konfirmasi</button>
        </form>
    </div>

    <script>
        // membuat select2
        $(document).ready(function() {
            $(" #alamat_kirim").select2();
        });
        // end membuat select2

        // Event listener untuk memanggil fungsi filter saat isi kotak pencarian berubah
        document.getElementById("searchBox").addEventListener("input", filterDropdown);

        // Fungsi untuk menerapkan filter pada dropdown
        function filterDropdown() {
            // Mendapatkan nilai dari kotak pencarian
            const filter = document.getElementById("searchBox").value.toUpperCase();
            // Mendapatkan elemen dropdown
            const dropdown = document.getElementById("alamat_kirim");
            // Mendapatkan elemen-elemen opsi di dropdown
            const options = dropdown.getElementsByTagName("option");

            // Iterasi melalui setiap opsi
            for (let i = 0; i < options.length; i++) {
                // Mendapatkan teks dari setiap opsi dan mengonversinya menjadi huruf besar
                const textValue = options[i].textContent || options[i].innerText;
                // Jika teks opsi cocok dengan filter, tampilkan; jika tidak, sembunyikan
                if (textValue.toUpperCase().indexOf(filter) > -1) {
                    options[i].style.display = "";
                } else {
                    options[i].style.display = "none";
                }
            }
        }

        // Ambil elemen select dan input pencarian
        const select = document.getElementById("alamat_kirim");
        const searchBox = document.getElementById("searchBox");

        // Tambahkan event listener untuk menampilkan dan menyembunyikan input ketika elemen select diklik
        select.addEventListener("click", function() {
            this.parentElement.classList.toggle("open");
        });

        // Tambahkan event listener untuk menyembunyikan input ketika klik di luar elemen select atau input
        document.addEventListener("click", function(event) {
            if (!select.contains(event.target)) {
                select.parentElement.classList.remove("open");
            }
        });

        // Event listener untuk memanggil fungsi filter saat isi kotak pencarian berubah
        document.getElementById("searchBox").addEventListener("input", filterDropdown);
    </script>

@endsection
