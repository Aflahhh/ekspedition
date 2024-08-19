@extends('dashboard.layouts.main')

<style>
    .cbp-mc-form {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
    }

    .cbp-mc-column {
        flex: 1 1 calc(25% - 20px);
        box-sizing: border-box;
    }

    .cbp-mc-column label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }

    .cbp-mc-column input,
    .cbp-mc-column select {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        box-sizing: border-box;
        border: 2px solid #3498db;
        border-radius: 4px;
    }

    .cbp-mc-column button {
        padding: 10px 20px;
        background-color: #28a745;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .select2-container .select2-selection--single {
        height: 40px;
        border: 2px solid #3498db;
        border-radius: 4px;
    }

    .select2-container .select2-selection--single .select2-selection__rendered {
        line-height: 36px;
    }

    .select2-container .select2-selection--single .select2-selection__arrow {
        top: 6px;
    }
</style>

@section('container')
    <div
        class="d-flex justify-content-center flex-wrap flex-md-nowrap align-items-center pt-2 pb-2 mb-3 border-bottom border-2">
        <h1 style="text-transform: uppercase;">TAMBAH DATA LAPORAN</h1>
    </div>

    @if (session()->has('success'))
        <div class="alert alert-primary col-lg-4" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <a href="/dashboard/posts" class="btn btn-success"><i class="bi bi-caret-left-fill"></i> Kembali</a>

    <form action="{{ route('transaksi.store') }}" method="POST" enctype="multipart/form-data" class="cbp-mc-form">
        @csrf
        <div class="cbp-mc-column">
            <label for="tanggal_muat">Tanggal Muat</label>
            <input type="date" id="tanggal_muat" name="tanggal_muat" placeholder="Tanggal Muat">

            <label for="fo">FO</label>
            <input type="text" id="fo" name="fo" placeholder="FO" autocomplete="off">

            <label for="fu">FU</label>
            <input type="text" id="fu" name="fu" placeholder="FU" autocomplete="off">

            <label for="driver">Driver</label>
            @if (Auth::user()->can('IsAdmin'))
                <select class="driver" name="driver" id="driver" data-tags="true">
                    <option value="">Pilih Driver</option>
                    @foreach ($user as $user)
                        <option value="{{ $user->driver }}">{{ $user->driver }}</option>
                    @endforeach
                </select>
            @else
                <input style="text-transform: capitalize" type="text" readonly id="driver_login" name="driver"
                    value="{{ Auth::user()->driver }}">
            @endif

            <label for="nomor_polisi">Nomor Polisi</label>
            @if (Auth::user()->can('IsAdmin'))
                <select class="nomor_polisi" name="nomor_polisi" id="nomor_polisi" data-tags="true">
                    @foreach ($armada as $item)
                        <option value="{{ $item->nomor_polisi }}">{{ $item->nomor_polisi }}</option>
                    @endforeach
                </select>
                <label for="jenis_armada">jenis armada</label>
                <select class="jenis_armada" name="jenis_armada" id="jenis_armada" data-tags="true">
                    <option value="">Pilih Jenis Armada</option>
                    @foreach ($armada as $item)
                        <option value="{{ $item->jenis_armada }}">{{ $item->jenis_armada }}</option>
                    @endforeach
                </select>
            @else
                <input style="text-transform: capitalize" type="text" readonly id="nomor_polisi_login"
                    name="nomor_polisi" value="{{ Auth::user()->nomor_polisi }}">
                <label for="jenis_armada">jenis armada</label>
                <input style="text-transform: capitalize" type="text" readonly id="jenis_armada_login"
                    name="jenis_armada" value="{{ Auth::user()->jenis_armada }}">
            @endif

            <label for="nama_customer">Nama Customer</label>
            <select class="nama_customer" name="nama_customer" id="nama_customer" data-tags="true">
                @foreach ($customer as $cust)
                    <option value="{{ $cust->nama_customer }}">{{ $cust->nama_customer }}</option>
                @endforeach
            </select>

            <div class="mb-3">
                <label for="alamat_kirim">Alamat Kirim</label>
                <div class="custom-select w-100">
                    <select class="alamat_kirim form-select" name="alamat_kirim" id="alamat_kirim">
                        <option value="">Pilih Alamat Kirim</option>
                        @if ($cost && $cost->count() > 0)
                            @foreach ($cost as $cust)
                                <option value="{{ $cust->alamat_kirim }}">{{ $cust->alamat_kirim }}</option>
                            @endforeach
                        @else
                            <option value="">No data available</option>
                        @endif
                    </select>
                </div>
                <x-input-error :messages="$errors->get('alamat_kirim')" class="mt-2" />
            </div>

            <label for="ongkos_angkut">Ongkos Angkut</label>
            <input type="number" class="form-control" id="ongkos_angkut" name="ongkos_angkut" readonly>
            <x-input-error :messages="$errors->get('ongkos_angkut')" class="mt-2" />

            <label for="biaya_rcf">Biaya RCF</label>
            <input type="text" id="biaya_rcf" name="biaya_rcf" placeholder="Biaya RCF" value="0" autocomplete="off">

            <label for="images">Bukti Surat Jalan</label>
            <div class="mb-3">
                <img class="image-priview col-sm-4 img-fluid mb-3">
                <input required onchange="imagePreview()" class="form-control @error('images') is-invalid @enderror"
                    type="file" id="images" name="images[]" multiple>
                @error('images')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <label for="biaya_return">Biaya Return</label>
            <input type="text" id="biaya_return" name="biaya_return" placeholder="Biaya Return" value="0"
                autocomplete="off">

            <label for="biaya_inap">Biaya Inap</label>
            <input type="text" id="biaya_inap" name="biaya_inap" placeholder="Biaya Inap" value="0"
                autocomplete="off">

            <label for="multi_drop">Multi Drop</label>
            <input type="text" id="multi_drop" name="multi_drop" placeholder="Multi Drop" value="0"
                autocomplete="off">

            <label for="tob">TOB</label>
            <input type="text" id="tob" name="tob" placeholder="TOB" value="0" autocomplete="off">

            <label for="total_biaya">Total Biaya</label>
            <input type="text" id="total_biaya" name="total_biaya" autocomplete="off">

            @if (Auth::user()->can('IsAdmin'))
                <input type="hidden" id="user_id" name="user_id" value="">
            @else
                <input type="hidden" id="user_id" name="user_id" value="{{ Auth::user()->id }}">
            @endif

            <input type="hidden" id="id_biaya" name="id_biaya" value="">


            <button type="submit" class="btn btn-success mt-3">Create Post</button>
        </div>
    </form>

    <script>
        $(document).ready(function() {
            $("#nama_customer, #alamat_kirim, #driver, #nomor_polisi, #jenis_armada").select2();

            // mengambil alamat kirim
            $('#jenis_armada').on('change', function() {
                var jenis_armada = $(this).val();

                if (jenis_armada) {
                    $.ajax({
                        type: 'GET',
                        url: '{{ route('get_alamat_kirim') }}',
                        data: {
                            jenis_armada: jenis_armada
                        },
                        success: function(data) {
                            $('#alamat_kirim').empty();
                            $('#alamat_kirim').append(
                                '<option value="">Pilih Alamat Kirim</option>');
                            $.each(data, function(index, value) {
                                $('#alamat_kirim').append('<option value="' + value
                                    .alamat_kirim + '">' + value.alamat_kirim +
                                    '</option>');
                            });
                        },
                        error: function(xhr, status, error) {
                            console.error(error); // Cek error jika terjadi
                        }
                    });
                } else {
                    $('#alamat_kirim').empty();
                    $('#alamat_kirim').append('<option value="">Pilih Alamat Kirim</option>');
                }
            });

            // mengambil id biaya
            $('#jenis_armada, #alamat_kirim, #jenis_armada_login').on('change', function() {
                var jenis_armada = $('#jenis_armada').val() || $('#jenis_armada_login').val();
                var alamat_kirim = $('#alamat_kirim').val();

                $.ajax({
                    type: 'GET',
                    url: '{{ route('get_id_biaya') }}',
                    data: {
                        jenis_armada: jenis_armada,
                        alamat_kirim: alamat_kirim
                    },
                    success: function(data) {
                        $('#id_biaya').val(data.id_biaya);
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            });


            // mengambil detail driver
            $('#driver').on('change', function() {
                var driver = $(this).val();

                if (driver) {
                    $.ajax({
                        type: 'GET',
                        url: '{{ route('get_driver_details') }}',
                        data: {
                            driver: driver
                        },
                        success: function(data) {
                            // Mengisi nomor polisi berdasarkan driver yang dipilih
                            $('#nomor_polisi').val(data
                                .nomor_polisi).trigger(
                                'change');

                            // Mengisi jenis armada berdasarkan driver yang dipilih
                            $('#jenis_armada').val(data
                                .jenis_armada).trigger(
                                'change');

                            $('#user_id').val(data.user_id)
                                .trigger('change');
                        },
                        error: function(xhr, status, error) {
                            console.error(
                                error
                            ); // Menampilkan error di console jika terjadi masalah
                        }
                    });
                } else {
                    // Jika driver tidak dipilih, kosongkan nomor polisi dan jenis armada
                    $('#nomor_polisi').val('').trigger('change');
                    $('#jenis_armada').val('').trigger('change');
                    $('#user_id').val('').trigger('change');
                }
            });

            // mengambil ongkos angkut dari tabel cost
            $('#alamat_kirim').on('change', function() {
                var jenis_armada = $('#jenis_armada').val();
                var alamat_kirim = $(this).val();

                $.ajax({
                    type: 'GET',
                    url: '{{ route('get_ongkos_angkut') }}',
                    data: {
                        jenis_armada: jenis_armada,
                        alamat_kirim: alamat_kirim
                    },
                    success: function(data) {
                        $('#ongkos_angkut').val(data.ongkos_angkut);
                        calculateTotalBiaya();
                    },
                    error: function(xhr, status, error) {
                        console.error(error); // Cek error jika terjadi
                    }
                });

                // Ketika driver dipilih, lakukan AJAX untuk mendapatkan nomor polisi dan jenis armada terkait

            });

            $('#searchBox').on('input', function() {
                var searchTerm = this.value.toLowerCase();
                var select = document.getElementById('alamat_kirim');
                var options = select.options;

                for (var i = 0; i < options.length; i++) {
                    var optionText = options[i].text.toLowerCase();
                    options[i].style.display = optionText.includes(searchTerm) ? '' : 'none';
                }
            });
        });

        function calculateTotalBiaya() {
            const biayaInputs = document.querySelectorAll(
                "#ongkos_angkut, #biaya_rcf, #biaya_return, #biaya_inap, #multi_drop, #tob");
            const totalBiayaInput = document.getElementById("total_biaya");

            let totalBiaya = 0;

            biayaInputs.forEach((input) => {
                const value = parseFloat(input.value) || 0;
                totalBiaya += value;
            });

            totalBiayaInput.value = totalBiaya.toFixed(0);

            biayaInputs.forEach((input) => {
                input.addEventListener("input", calculateTotalBiaya);
            });
        }

        calculateTotalBiaya();

        function imagePreview() {
            const image = document.querySelector('#images');
            const imgPriview = document.querySelector('.image-priview');

            imgPriview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPriview.src = oFREvent.target.result;
            }
        }
    </script>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/dashboard.css') }}">
@endsection
