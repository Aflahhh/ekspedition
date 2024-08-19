<nav class="navbar navbar-dark navbar-expand-lg  bg-warning">
    <div class="container">
        <a class="navbar-brand" href="#">CV. PUTRA ARDHIANSYAH</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            </ul>

            <ul class="navbar-nav ms-auto">
                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Welcome Back, {{ auth()->user()->name }}
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="/dashboard"><i class="bi bi-layout-text-sidebar"></i>
                                    Dashboard</a></li>
                            <li>
                                <form action="/logout" method="post">
                                    @csrf
                                    <button type="submit"><i class="bi bi-box-arrow-right"></i>
                                        Keluar</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item">
                        <a href="/login" class="nav-link {{ $active === 'login' ? 'active' : '' }}"><i
                                class="fa-solid fa-right-to-bracket mx-1"></i>Login</a>
                    </li>
                </ul>
            @endauth



        </div>
    </div>


</nav>
