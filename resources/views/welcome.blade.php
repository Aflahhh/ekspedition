<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Cv Putra Ardiansyah</title>
    <!-- link css -->
    <link rel="stylesheet" href="{{ asset('build/assets/css/landing.css') }}">

    <!-- link google font -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Onest:wght@100..900&display=swap" rel="stylesheet" />

    <!-- link boostrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <!-- End Link Boostrap -->
    <script src="https://unpkg.com/scrollreveal"></script>
</head>

<body>
    <!-- Navbar Section -->
    <nav class="navbar navbar-expand-lg rounded fixed-top" aria-label="Thirteenth navbar example ">
        <div class="container-fluid">
            <a class="navbar-brand col-lg-3 fw-bold" href="">Cv Putra Ardiansyah</a>
            <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarsExample11" aria-controls="navbarsExample11" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>


            <div class="collapse navbar-collapse d-lg-flex" id="navbarsExample11">
                <ul class="navbar-nav col-lg-8 justify-content-lg-center">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#home">Tentang </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#layanan">Layanan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#mitra">Mitra</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#customer">Customer</a>
                    </li>
                </ul>
                <div class="d-lg-flex col-lg-4 justify-content-lg-end">
                    <button class="btn" onclick="window.location.href='/login'">Login</button>

                </div>
            </div>
        </div>
    </nav>
    <!-- End Navbar Section -->

    <div class="halaman">
        <!-- Hero Section -->
        <section class="hero" id="home">
            <div class="container col-xxl-8 mt-5">
                <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
                    <div class="col-lg-6">
                        <img src="/build/assets/image/hero.png" class="d-block mx-lg-auto img-fluid" id="img-hero"
                            width="700" height="500" loading="lazy" />
                    </div>
                    <div class="col-lg-6" id="teks-hero">
                        <h1 class="display-5 fw-bold lh-1 mb-3">Jalur Tercepat, <span class="d-block" id="typewriter">
                                Barang Selamat</span></h1>
                        <p class="lead fs-6">
                            Dengan armada truk yang terawat dan sopir berpengalaman, kami memastikan setiap barang yang
                            anda kirimkan akan sampai dalam kondisi terbaik. Percayakan pengiriman anda kepada kami dan
                            nikmati <span
                                style="font-weight: bold; font-style: italic; text-decoration: underline">layanan
                                ekspedisi yang andal dan profesional.</span>
                        </p>
                        <button class="btn-pesan" id="email">
                            Pesan Sekarang
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <!-- Services Section -->
        <section id="layanan">
            <div class="container mt-5">
                <div class="text-center mb-5" id="layanan-sec">
                    <h2>Layanan Kami</h2>
                    <p>Kami mempunyai berbagai layanan ekspedisi untuk memenuhi kebutuhan . <span
                            class="d-block fw-bold">Dengan Menawarkan Berbagai Armada.</span></p>
                </div>
                <!-- kartu -->
                <div class="row ">
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card" id="kartu-1">
                            <div class="img-card"><img src="build/assets/image/download_no_bg1.png" alt="" />
                            </div>
                            <div class="card-info">
                                <p class="text-title">Engkel</p>
                                <p class="text-body">Kapasitas angkutnya bisa mencapai 3 hingga 8 ton</p>
                            </div>
                            <div class="card-footer" style="background-color: #7969e5;   border-radius: 0%;">
                                <a href="detail.html#tronton">Detail</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card" id="kartu-2">
                            <div class="img-card"><img src="build/assets/image/truk.png" alt="" /></div>
                            <div class="card-info">
                                <p class="text-title">Tronton</p>
                                <p class="text-body">Kapasitas angkutnya bisa mencapai 20 hingga 30 ton</p>
                            </div>
                            <div class="card-footer" style="background-color: #7969e5;   border-radius: 0%;">
                                <a href="detail.html#tronton">Detail</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card" id="kartu">
                            <div class="img-card"><img src="build/assets/image/truk.png" alt="" /></div>
                            <div class="card-info">
                                <p class="text-title">Tronton Build up</p>
                                <p class="text-body">Kapasitas angkutnya bisa mencapai 40 hingga 60 ton</p>
                            </div>
                            <div class="card-footer" style="background-color: #7969e5;   border-radius: 0%;">
                                <a href="detail.html#build-up">Detail</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 ">
                        <div class="card" id="kartu-3">
                            <div class="img-card"><img src="build/assets/image/download_no_bg2.png" alt="" />
                            </div>
                            <div class="card-info">
                                <p class="text-title">Double Engkel</p>
                                <p class="text-body">Kapasitas angkutnya bisa mencapai 10 hingga 15 ton</p>
                            </div>
                            <div class="card-footer" style="background-color: #7969e5;   border-radius: 0%;">
                                <a href="detail.html#double-engkel">Detail</a>
                            </div>
                        </div>
                    </div>
                </div>
        </section>


        <!-- Mitra & Customer Section -->
        <section id="mitra">
            <div class="container">
                <div class="text-center mt-5" id="judul-mitra">
                    <h2>Mitra</h2>
                </div>

                <div class="row align-items-center justify-content-lg-center justify-content-md-center g-5 pt-1 pb-4"
                    id="mitra-sec">
                    <div class="col-lg-8 col-md-10 glassy-background">
                        <div class="row   align-items-center justify-content-md-center">
                            <div class="col-lg-6 col-md-6  py-5">
                                <img src="/build/assets/image/logo-mitra.png" class="d-block mx-lg-auto img-fluid"
                                    alt="Bootstrap Themes" width="600" height="500" loading="lazy" />
                            </div>
                            <div class="col-lg-6 ">
                                <h1 class="display-6 fw-bold lh-1 mb-3 " id="judul-mitra">Pt Purinusa Eka Persada</h1>
                                <p class="lead fs-6">
                                    Merupakan mitra Cv Putra Arsiansyah, yang berperan penting dalam mendukung
                                    pertumbuhan dan kesuksesan bisnis kami. Dengan dukungan PT Purinusa Eka Persada,
                                    kami mampu meningkatkan efisiensi operasional dan memperluas jangkauan pasar kami.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Mitra & Customer Section -->

        <!-- Customer Section -->
        <section id="customer">
            <div class="container">
                <div class="text-center mt-5" id="judul-cust">
                    <h2>Customer</h2>
                </div>

                <div class="row justify-content-center align-items-center g-5 pt-1 pb-4">
                    <div class="d-flex justify-content-center text-center">
                        <div class="col-lg-6 col-sm-8 col-sm-2 row-customer">
                            <div class="col-lg-2 isi-card-cust">
                                <div class="jumlah-customer fw-bold" id="count-customer">
                                    100+
                                </div>
                                <div class="nama-customer ">
                                    Customer
                                </div>
                            </div>
                            <div class="col-lg-2 isi-card-cust">
                                <div class="jumlah-customer fw-bold" id="count-city">
                                    10+
                                </div>
                                <div class="nama-customer ">
                                    Kota
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-lg-flex justify-content-center d-md-flex text-center row-p " id="gambar-customer">
                        <div class="col-lg-6 col-md-8 col-sm-6 d-flex justify-content-center align-items-center"
                            style="gap: 25px;">
                            <div class="col-lg-3 col-md-4 img-cust justify-content-center">
                                <img src="/build/assets/image/djarum.png" class="d-flex mx-lg-auto img-fluid "
                                    width="600" height="500" loading="lazy" />
                            </div>
                            <div class="col-lg-3 col-md-4 img-cust justify-content-center">
                                <img src="/build/assets/image/garuda.png" class="d-flex mx-lg-auto img-fluid "
                                    width="600" height="500" loading="lazy" />
                            </div>
                            <div class="col-lg-3 col-md-4 img-cust justify-content-center">
                                <img src="/build/assets/image/indofood-cbp.png" class="d-flex mx-lg-auto img-fluid "
                                    width="600" height="500" loading="lazy" />
                            </div>
                        </div>
                    </div>
                    <div class="d-lg-flex justify-content-center d-md-flex text-center row-p " id="gambar-customer">
                        <div class="col-lg-6 col-md-8 col-sm-6 d-flex justify-content-center align-items-center"
                            style="gap: 25px;">
                            <div class="col-lg-3 col-md-4 img-cust justify-content-center">
                                <img src="/build/assets/image/polytron.png" class="d-flex mx-lg-auto img-fluid "
                                    width="600" height="500" loading="lazy" />
                            </div>
                            <div class="col-lg-3 col-md-4 img-cust justify-content-center">
                                <img src="/build/assets/image/dua-kelinci.png" class="d-flex mx-lg-auto img-fluid "
                                    width="600" height="500" loading="lazy" />
                            </div>
                            <div class="col-lg-3 col-md-4 img-cust justify-content-center">
                                <img src="/build/assets/image/kino.png" class="d-flex mx-lg-auto img-fluid "
                                    width="600" height="500" loading="lazy" />
                            </div>
                        </div>
                    </div>
                </div>
        </section>
        <!-- End Customer Section -->

        <!-- Footer -->
        <footer class="bg-white rounded-lg shadow m-4">
            <div class="container-fluid p-4">
                <div class="row align-items-center justify-content-center">
                    <div class="col-12 col-md-auto mb-3 mb-md-0">
                        <span class="text-sm text-gray-500">© 2024 CV PUTRA ARDIANSYAH. By <span><a href=""
                                    class="text-decoration-none">@aflahnabil__</a></span></span>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <script src="build/assets/js/landing.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>
