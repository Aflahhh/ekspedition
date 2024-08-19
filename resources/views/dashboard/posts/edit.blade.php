@extends('dashboard.layouts.main')
<style>
    /* Menyembunyikan input pencarian secara default */
    .custom-select .search-box {
        display: none;
    }

    /* Menampilkan input pencarian ketika elemen select diklik */
    .custom-select.open .search-box {
        display: block;
    }

    .cbp-mc-form {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
    }

    .cbp-mc-column {
        flex: 1 1 calc(25% - 20px);
        /* 4 columns with gap adjustment */
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
        /* Custom height */
        border: 2px solid #3498db;
        border-radius: 4px;
    }

    .select2-container .select2-selection--single .select2-selection__rendered {
        line-height: 36px;
        /* Center text vertically */
    }

    .select2-container .select2-selection--single .select2-selection__arrow {
        top: 6px;
        /* Adjust arrow position */
    }
</style>
@section('container')
    <div class=" d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 style="text-transform: uppercase">EDIT POST</h1>
    </div>

    <a href="/dashboard/posts" class="btn btn-primary mb-3"><i class="bi bi-caret-left-fill"></i> Back</a>
    <form class="cbp-mc-form" method="post" action="/dashboard/posts/{{ $transaksis->id }}" enctype="multipart/form-data">
        @method('put')
        @csrf

        <div class="cbp-mc-column">
            <label for="tanggal_muat">Tanggal Muat</label>
            <input type="date" id="tanggal_muat" name="tanggal_muat" placeholder="Tanggal Muat"
                value="{{ old('tanggal_muat', $transaksis->tanggal_muat) }}">

            <label for="fo" class="form-label me-2">FO</label>
            <input type="text" name="fo" class="form-control @error('fo')
      is-invalid
      @enderror"
                id="fo" value="{{ old('fo', $transaksis->fo) }}">
            @error('fo')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror

            <div class="mb-3">
                <label for="fu" class="form-label me-2">FU</label>
                <input type="text" id="fu" name="fu" class="form-control" placeholder="FU"
                    value="{{ old('fu', $transaksis->fu) }}">
            </div>

            <label for="driver">Driver</label>
            @if (Auth::user()->can('IsAdmin'))
                <select class="driver" name="driver" id="driver" data-tags="true">
                    <option value="{{ old('driver', $transaksis->driver) }}">{{ $transaksis->driver }}</option>
                    @foreach ($user as $user)
                        @if ($user->driver !== $transaksis->driver)
                            <option value="{{ old('driver', $user->driver) }}">{{ $user->driver }}</option>
                        @endif
                    @endforeach
                </select>
            @else
                <input style="text-transform: capitalize" type="text" readonly id="driver_login" name="driver"
                    value="{{ Auth::user()->driver }}">
            @endif

            <label for="nomor_polisi">nomor_polisi</label>
            @if (Auth::user()->can('IsAdmin'))
                <select class="nomor_polisi" name="nomor_polisi" id="nomor_polisi" data-tags="true">
                    <option value="{{ old('nomor_polisi', $transaksis->nomor_polisi) }}">{{ $transaksis->nomor_polisi }}
                    </option>
                    @foreach ($armada as $userNopol)
                        @if ($userNopol->nomor_polisi !== $transaksis->nomor_polisi)
                            <option value="{{ old('nomor_polisi', $userNopol->nomor_polisi) }}">
                                {{ $userNopol->nomor_polisi }}</option>
                        @endif
                    @endforeach
                </select>
            @else
                <input style="text-transform: capitalize" type="text" readonly id="nomor_polisi_login"
                    name="nomor_polisi" value="{{ Auth::user()->nomor_polisi }}">
            @endif

            <button type="submit" class="btn btn-success">Update</button>
        </div>


        <div class="cbp-mc-column">
            <label for="nama_customer">Nama Customer</label>
            <select class="nama-customer" name="nama_customer" id="nama_customer" data-tags="true">
                <option value="{{ old('nama_customer', $transaksis->nama_customer) }}">{{ $transaksis->nama_customer }}
                </option>
                @foreach ($customer as $cust)
                    @if ($cust->nama_customer !== $transaksis->nama_customer)
                        <option value="{{ old('nama_customer', $cust->nama_customer) }}">{{ $cust->nama_customer }}
                        </option>
                    @endif
                @endforeach
            </select>

            <label for="alamat_kirim">Alamat Kirim</label>
            <div class="custom-select">
                <select class="alamat_kirim" name="alamat_kirim" id="alamat_kirim">
                    <option value="">Pilih Alamat Kirim</option>
                    @foreach ($cost as $cust)
                        <option value="{{ $cust->alamat_kirim }}"
                            {{ $transaksis->alamat_kirim == $cust->alamat_kirim ? 'selected' : '' }}>
                            {{ $cust->alamat_kirim }}</option>
                    @endforeach
                </select>
                <input type="text" id="searchBox" class="search-box" placeholder="Cari...">
            </div>


            <label for="jenis_armada">jenis armada</label>
            @if (Auth::user()->can('IsAdmin'))
                <select class="jenis_armada" name="jenis_armada" id="jenis_armada" data-tags="true">
                    <option value="{{ old('jenis_armada', $transaksis->jenis_armada) }}">{{ $transaksis->jenis_armada }}
                    </option>
                    @foreach ($armada as $jenis)
                        @if ($jenis->jenis_armada !== $transaksis->jenis_armada)
                            <option value="{{ old('jenis_armada', $jenis->jenis_armada) }}">{{ $jenis->jenis_armada }}
                            </option>
                        @endif
                    @endforeach
                </select>
            @else
                <input style="text-transform: capitalize" type="text" readonly id="jenis_armada_login"
                    name="jenis_armada" value="{{ Auth::user()->jenis_armada }}">
            @endif

            <label for="ongkos_angkut">Ongkos Angkut</label>
            <input type="text" id="ongkos_angkut" name="ongkos_angkut"
                value="{{ old('ongkos_angkut', $transaksis->ongkos_angkut) }}" readonly>


            <label for="images" class="form-label ">Upload Image</label>
            <input type="hidden" name="oldImages" value="{{ implode(',', $transaksis->images) }}">
            @if ($transaksis->images)
                @foreach ($transaksis->images as $image)
                    <img class="image-priview col-sm-4 img-fluid mb-3 d-block mx-2" src="{{ asset($image) }}"
                        style="width: 100px;">
                @endforeach
            @endif
            <input onchange="imagePreview()"
                class="form-control @error('images')
                is-invalid
                @enderror" type="file"
                id="images" name="images[]" multiple>
            @error('images')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="cbp-mc-column">
            <label for="biaya_return">Biaya Return</label>
            <input type="text" id="biaya_return" class="form-control" name="biaya_return" placeholder="Biaya Return"
                value="{{ old('biaya_return', $transaksis->biaya_return) }}">

            <label for="biaya_inap">Biaya Inap</label>
            <input type="text" id="biaya_inap" class="form-control" name="biaya_inap" placeholder="Biaya Inap"
                value="{{ old('biaya_inap', $transaksis->biaya_inap) }}">


            <label for="multi_drop">Multi Drop</label>
            <input type="text" id="multi_drop" class="form-control" name="multi_drop" placeholder="Biaya Inap"
                value="{{ old('multi_drop', $transaksis->multi_drop) }}">


            <label for="tob">TOB</label>
            <input type="text" id="tob" name="tob" class="form-control me-2" placeholder="Biaya Inap"
                value="{{ old('tob', $transaksis->tob) }}">

            <label for="total_biaya">Total Biaya</label>
            <input type="text" id="total_biaya" class="form-control" name="total_biaya" placeholder="Biaya Inap"
                value="{{ old('total_biaya', $transaksis->total_biaya) }}">

            @if (Auth::user()->can('IsAdmin'))
                <input type="hidden" id="user_id" name="user_id" value="">
            @else
                <input type="hidden" id="user_id" name="user_id" value="{{ Auth::user()->id }}">
            @endif

            <input type="text" id="id_biaya" name="id_biaya" value="">

        </div>
    </form>

    <script>
        $(document).ready(function() {
            $("#nama_customer, #alamat_kirim, #driver, #nomor_polisi, #jenis_armada").select2();

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

            $('#jenis_armada, #alamat_kirim').on('change', function() {
                var jenis_armada = $('#jenis_armada').val();
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
