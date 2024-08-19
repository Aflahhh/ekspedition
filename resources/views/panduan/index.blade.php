@extends('dashboard.layouts.main')


@section('container')
    {{-- JUDUL --}}
    <div
        class="d-flex justify-content-center text-center flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 style="text-transform: uppercase;">PANDUAN INPUT DATA LAPORAN EKSPEDISI</h1>
    </div>
    {{-- END JUDUL --}}

    {{-- isi --}}

    <div class="kontainer">
        <div class="row justify-content-center d-flex">
            <div class="col-md-8 ">
                <div class="card text-center">
                    <div class="card-header">
                        <h4 class="card-title">URUTAN PENGISIAN DATA SESUAI SURAT JALAN</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group ">
                                    <div class="d-block"
                                        style="text-transform: uppercase; font-weight: bold; justify-content: center;">
                                        <p>1. Isi Tanggal Laporan Ekspedisi</p>
                                        <p>2. Isi Nomor FO</p>
                                        <p>3. isi nomor FU</p>
                                        <p>4. isi nama customer</p>
                                        <p>5. isi alamat kirim</p>
                                        <p>6. isi biaya tambahan jika ada</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="img-kontainer mt-3">
        <div class="row justify-content-center d-flex">
            <div class="col-md-12 ">
                <div class="card text-center">
                    <div class="card-header">
                        <h4 class="card-title">PETUNJUK GAMBAR PENGISIAN DATA</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="judul-panduan">1. Isi Tanggal Laporan Ekspedisi</div>
                                <img src="{{ URL('images/bukti-1.jpg') }}" alt="">
                            </div>
                            <div class="col-md-12">
                                <div class="judul-panduan">2. Isi Nomor FO</div>
                                <img src="{{ URL('images/bukti.jpg') }}" alt="">
                            </div>
                            <div class="col-md-12">
                                <div class="judul-panduan">3. isi nomor FU</div>
                                <img src="{{ URL('images/bukti.jpg') }}" alt="">
                            </div>
                            <div class="col-md-12">
                                <div class="judul-panduan">4. isi nama customer</div>
                                <img src="{{ URL('images/bukti.jpg') }}" alt="">
                            </div>
                            <div class="col-md-12">
                                <div class="judul-panduan">5. isi alamat kirim</div>
                                <img src="{{ URL('images/bukti.jpg') }}" alt="">
                            </div>
                            <div class="col-md-12">
                                <div class="judul-panduan">6. isi biaya tambahan jika ada</div>
                                <img src="{{ URL('images/bukti.jpg') }}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- end isi --}}
@endsection
