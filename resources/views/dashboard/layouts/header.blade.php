<header class="navbar sticky-top bg-primary flex-md-nowrap p-0 shadow" data-bs-theme="dark">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6 text-white" href="#">CV Putra Ardiansyah</a>

    <!-- Tombol Toggle Sidebar dan Tombol Logout -->
    <div class="navbar-nav flex-row d-md-none ms-auto">
        <button class="nav-link text-white me-3" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarMenu"
            aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <i class="bi bi-list"></i>
        </button>
    </div>

    <form action="/logout" method="post">
        @csrf
        <button style="color: white; margin-top:0.5em" type="submit" class="nav-link px-3"><i
                class="bi bi-box-arrow-right"></i>
            Keluar</button>
    </form>

</header>
