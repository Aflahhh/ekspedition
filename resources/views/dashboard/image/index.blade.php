@extends('dashboard.layouts.main')
@section('title', 'Biaya')
@section('container')
    <div
        class="d-flex justify-content-center flex-wrap flex-md-nowrap align-items-center pt-2 pb-2 mb-3 border-bottom border-2">
        <h1 style="text-transform: uppercase;">Tambah Gambar Armada</h1>
    </div>

    <div class="mb-3">
        <a href="/dashboard/biaya" class="btn btn-success"><i class="bi bi-caret-left-fill"></i> Kembali</a>
    </div>

    <div class="container mt-4 mb-4 d-flex justify-content-center">
        <div class="table-responsive mb-2">
            <table class="table table-responsive table-bordered">
                <thead class="table-light">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Jenis Armada</th>
                        <th scope="col">Alamat Kirim</th>
                        <th scope="col">Ongkos Angkut </th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td style="text-align: center;" class="m-3">
                        <form class="d-inline" action="" method="post">
                            @method('delete')
                            @csrf
                            <button id="delete" class="btn btn-danger border-0"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tbody>
            </table>
            <form method="POST" action="{{ route('user.post') }}" style="width: 50%;">
                @csrf
                <div class="mb-3">
                    <label for="driver" class="form-label">Nama</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                        <input type="text" id="driver" name="driver" class="form-control" value="{{ old('driver') }}"
                            required autofocus placeholder="Nama">
                    </div>
                    <x-input-error :messages="$errors->get('driver')" class="mt-2" />
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}"
                            required autofocus placeholder="Email">
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div class="mb-3">
                    <label for="nomor_polisi" class="form-label">Nomor Polisi Armada</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa fa-truck"></i></span>
                        <select name="nomor_polisi" id="nomor_polisi" class="form-select">
                            <option value="">Pilih Nomor Polisi</option>

                        </select>
                    </div>
                    <x-input-error :messages="$errors->get('nomor_polisi')" class="mt-2" />
                </div>

                <div class="mb-3">
                    <label for="jenis_armada" class="form-label">Jenis Armada</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa fa-info-circle"></i></span>
                        <select name="jenis_armada" id="jenis_armada" class="form-select">
                            <option value="">Pilih Jenis Armada</option>
                        </select>
                    </div>
                    <x-input-error :messages="$errors->get('jenis_armada')" class="mt-2" />
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        <input type="password" id="password" name="password" class="form-control" required
                            placeholder="Password">
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control"
                            required placeholder="Confirm Password">
                    </div>
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <button type="submit" class="btn btn-primary w-100">Konfirmasi</button>
            </form>

        </div>


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
