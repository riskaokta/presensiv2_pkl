<!DOCTYPE html>
<html lang="en">

<head>

    <style>
        .main-sidebar .nav-sidebar .nav-link {
            font-size: 15px;
            /* Ukuran teks */
            padding: 10px 20px;
            /* Jarak dalam elemen */
            display: flex;
            align-items: center;
        }

        .main-sidebar .nav-sidebar .nav-icon {
            margin-right: 10px;
            /* Jarak ikon ke teks */
            width: 20px;
            text-align: center;
        }

        .main-sidebar .nav-sidebar .nav-link p {
            margin: 0;
            /* Biar teks-nya sejajar vertikal */
        }
    </style>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Presensi</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet"
    type="text/css" />
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
    integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                </li>
            </ul>
            <!-- <form class="form-inline ml-auto">
                <div class="input-group input-group-sm">
                    <input class="form-control form-control-navbar" type="search" placeholder="Search"
                        aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-navbar" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </form> -->
            <!-- <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="fas fa-user"></i> Admin
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <a href="#" class="dropdown-item">Logout</a>
                    </div>
                </li>
            </ul> -->

            <ul class="navbar-nav ml-auto"> <!-- Perubahan di sini -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="fas fa-user"></i> Admin
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <!-- Form Logout -->
                        <form action="{{ route('logoutadmin') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item">Logout</button>
                        </form>
                    </div>
                </li>
            </ul>

        </nav>

        @yield('content')

        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="#" class="brand-link">
                <span class="brand-text font-weight-light">Admin Presensi</span>
            </a>
            <div class="sidebar">
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                        <!-- <li class="nav-item"><a class="nav-link" href="#"><i class="nav-icon fas fa-home"></i>
                                <p>Dashboard</p>
                            </a></li> -->
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('dashboardadmin') ? 'active' : '' }}"
                                href="/dashboardadmin">
                                <i class="nav-icon fas fa-home"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>

                        <!-- <li class="nav-item"><a class="nav-link" href="/mahasiswa"><i class="nav-icon fas fa-user"></i>
                                <p>Daftar Mahasiswa</p>
                            </a></li> -->
                        <a class="nav-link {{ Request::is('mahasiswa') ? 'active' : '' }}" href="/mahasiswa">
                            <i class="nav-icon fas fa-user"></i>
                            <p>Daftar Mahasiswa</p>
                        </a>

                        <!-- <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-user"></i>
                                <p>Data Master<i class="right fas fa-angle-left"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item"><a class="nav-link" href="/mahasiswa"><i
                                            class="far fa-circle nav-icon"></i>
                                        <p>Daftar Mahasiswa</p>
                                    </a></li>
                                <li class="nav-item"><a class="nav-link" href="#"><i class="far fa-circle nav-icon"></i>
                                        <p>History Presensi</p>
                                    </a></li>
                                <li class="nav-item"><a class="nav-link" href="#"><i class="far fa-circle nav-icon"></i>
                                        <p>Unduh Rekap Presensi</p>
                                    </a></li>
                            </ul>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="/presensi/monitoring"><i
                                    class="nav-icon fas fa-desktop"></i>
                                <p>Monitoring Presensi</p>
                            </a></li> -->

                        <!-- <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-clipboard-data">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path
                                            d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" />
                                        <path
                                            d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" />
                                        <path d="M9 17v-4" />
                                        <path d="M12 17v-1" />
                                        <path d="M15 17v-2" />
                                        <path d="M12 17v-1" />
                                    </svg></i>
                                <p>Laporan<i class="right fas fa-angle-left"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item"><a class="nav-link" href="/presensi/laporan"><i
                                            class="far fa-circle nav-icon"></i>
                                        <p>Presensi</p>
                                    </a></li>
                                <li class="nav-item"><a class="nav-link" href="/presensi/rekap"><i
                                            class="far fa-circle nav-icon"></i>
                                        <p>Rekap Presensi</p>
                                    </a></li>
                            </ul>
                        </li> -->
                        <li
                            class="nav-item has-treeview {{ Request::is('presensi/laporan') || Request::is('presensi/rekap') ? 'menu-open' : '' }}">
                            <a href="#"
                                class="nav-link {{ Request::is('presensi/laporan') || Request::is('presensi/rekap') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-clipboard-list"></i>
                                <p>
                                    Laporan
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a class="nav-link {{ Request::is('presensi/laporan') ? 'active' : '' }}"
                                        href="/presensi/laporan">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Presensi</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ Request::is('presensi/rekap') ? 'active' : '' }}"
                                        href="/presensi/rekap">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Rekap Presensi</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                    </ul>
                </nav>
            </div>
        </aside>
        <!-- <div class="content-wrapper">
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Daftar Mahasiswa</h3>
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>NIM</th>
                                                <th>Nama</th>
                                                <th>Kelas</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>12345</td>
                                                <td>Ahmad</td>
                                                <td>A</td>
                                            </tr>
                                            <tr>
                                                <td>67890</td>
                                                <td>Budi</td>
                                                <td>B</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Presensi Mahasiswa</h3>
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>NIM</th>
                                                <th>Nama</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>12345</td>
                                                <td>Ahmad</td>
                                                <td>Hadir</td>
                                            </tr>
                                            <tr>
                                                <td>67890</td>
                                                <td>Budi</td>
                                                <td>Absen</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div> -->
        <!-- <footer class="main-footer text-center">
            <strong>Copyright &copy; 2025 <a href="#">Admin Presensi</a>.</strong> All rights reserved.
        </footer> -->
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/js/adminlte.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    @stack('myscript')
</body>
<!-- Footer -->
<footer class="main-footer text-center">
    <strong>Copyright &copy; 2025 <a href="#">by.Riska Oktafia</a>.</strong>
</footer>

</html>