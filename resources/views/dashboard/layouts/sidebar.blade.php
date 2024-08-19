<style>
    .sidebar {
        position: fixed;
    }

    .sidebar .nav-link.active {
        color: blue;
    }

    .nav-link {
        color: black
    }

    .image img {
        display: block;
        margin: 0 auto;
        width: 100px;
        /* Sesuaikan ukuran dengan kebutuhan */
        height: 100px;
        /* Sesuaikan ukuran dengan kebutuhan */
        object-fit: cover;
        /* Untuk memastikan gambar tidak terdistorsi */
        border-radius: 50%;
        /* Membuat gambar menjadi lingkaran */
    }

    @media (min-width: 768px) {
        .sidebar .offcanvas-lg {
            position: -webkit-sticky;
            position: sticky;
            top: 48px;
        }
    }

    .sidebar-heading {
        font-size: .75rem;
    }

    /* .sidebar{
    height: 100vh; */
    }
</style>
<div class="sidebar border border-right col-md-3 col-lg-2 p-0 bg-body-tertiary">
    <div class="offcanvas-md offcanvas-end bg-body-tertiary" tabindex="-1" id="sidebarMenu"
        aria-labelledby="sidebarMenuLabel">
        <div class="offcanvas-header">
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu"
                aria-label="Close"></button>
        </div>
        <div class="offcanvas-body d-md-flex flex-column p-0 pt-lg-3 overflow-y-auto">

            <h6 class="sidebar-heading d-block align-items-center mx-3 pt-2 mb-1 text-uppercase">
                <div style="text-align: center;">
                    <span
                        style="font-size: 18px; display: block; margin-top:10px; margin-bottom:10px">{{ auth()->user()->driver }}
                    </span>
                </div>
            </h6>


            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="side-link {{ Request::is('dashboard') ? 'active' : '' }} nav-link d-flex align-items-center gap-2 "
                        aria-current="page" href="/dashboard">
                        <i class="bi bi-database"></i>
                        Dashboard
                    </a>
                </li>
                @if (auth()->user()->driver != 'mitra' && auth()->user()->driver != 'sulistiawan')
                    <li class="nav-item">
                        <a class="side-link nav-link {{ Request::is('profile') ? 'active' : '' }} d-flex align-items-center gap-2"
                            href="/profile">
                            <i class="bi bi-person-gear"></i>
                            Profile
                        </a>
                    </li>
                @endif
                <li class="nav-item">
                    <a class="side-link nav-link {{ Request::is('dashboard/posts*') ? 'active' : '' }} d-flex align-items-center gap-2"
                        href="/dashboard/posts">
                        <i class="bi bi-card-text"></i>
                        Laporan
                    </a>
                </li>
                <hr>
                @can('IsAdmin')
                    <h6 class="sidebar-heading d-flex justify-content-between align-items-center mx-3 pt-2 mb-1 text-auto">
                        <span style="font-size: 18px">Administrator</span>
                    </h6>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="side-link {{ Request::is('dashboard/user*') ? 'active' : '' }} nav-link d-flex align-items-center gap-2 "
                                aria-current="page" href="/dashboard/user">
                                <i class="fa-solid fa-users"></i>
                                User
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="side-link {{ Request::is('dashboard/armada*') ? 'active' : '' }} nav-link d-flex align-items-center gap-2 "
                                aria-current="page" href="/dashboard/armada">
                                <i class="fa-solid fa-truck"></i>
                                Armada
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="side-link {{ Request::is('dashboard/biaya*') ? 'active' : '' }} nav-link d-flex align-items-center gap-2 "
                                aria-current="page" href="/dashboard/biaya">
                                <i class="fa-solid fa-money-bill-1-wave"></i>
                                Biaya
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="side-link {{ Request::is('dashboard/customer*') ? 'active' : '' }} nav-link d-flex align-items-center gap-2 "
                                aria-current="page" href="/dashboard/customer">
                                <i class="fa-solid fa-building"></i>
                                Penerima
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="side-link {{ Request::is('dashboard/print*') ? 'active' : '' }} nav-link d-flex align-items-center gap-2 "
                                aria-current="page" href="/dashboard/print">
                                <i class="fa-solid fa-print"></i>
                                Cetak
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="side-link {{ Request::is('dashboard/kirim*') ? 'active' : '' }} nav-link d-flex align-items-center gap-2 "
                                aria-current="page" href="/dashboard/kirim">
                                <i class="fa-solid fa-paper-plane"></i>
                                Kirim File
                            </a>
                        </li>
                    </ul>
                    <hr>
                @endcan

                <li class="nav-item">
                    <a class="side-link nav-link d-flex align-items-center gap-2" href="/">
                        <i class="fa-solid fa-house"></i>
                        Home
                    </a>
                </li>
            </ul>

        </div>
    </div>
</div>
