<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ env('APP_NAME') }} | @yield('title')</title>
    <!-- DataTable -->
    <link rel="stylesheet" href="{{ asset('adminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminLTE/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('adminLTE/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminLTE/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('adminLTE/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('adminLTE/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->

            <ul class="navbar-nav ml-auto">
                @can('approval_pinjaman_bendahara')
                    <!-- Navbar Search -->
                    @php
                        $notificationBendahara = App\Models\Loan::whereHas('loanApproval', function ($query) {
                            $query->where('approved', 0)->where('level', 1);
                        })
                            ->latest()
                            ->paginate(3);
                        
                        $loanCount = App\Models\Loan::whereHas('loanApproval', function ($query) {
                            $query->where('approved', 0)->where('level', 1);
                        })->count();
                    @endphp
                    <li class="nav-item dropdown">
                        <a class="nav-link" data-toggle="dropdown" href="#">
                            <i class="fas fa-bell"></i>
                            <span class="badge badge-danger navbar-badge">{{ $loanCount }}</span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <span class="dropdown-header">Notifications</span>
                            <div class="dropdown-divider"></div>
                            @forelse ($notificationBendahara as $notifBendahara)
                                <a href="{{ route('admin.loans.show', $notifBendahara->id) }}" class="dropdown-item">
                                    Pengajuan Baru - <i class="fas fa-clock"></i>
                                    {{ $notifBendahara->created_at->diffForHumans() }}
                                    <br>
                                    <small>
                                        <i class="fas fa-user"></i> {{ $notifBendahara->studentParent->user->name }}
                                    </small>
                                </a>
                            @empty
                                <p class="dropdown-item">
                                    Belum ada notifikasi
                                </p>
                            @endforelse
                        </div>
                    </li>
                @endcan
                @can('approval_pinjaman_ketua')
                    <!-- Navbar Search -->
                    @php
                        $notificationKetua = App\Models\Loan::whereHas('loanApproval', function ($query) {
                            $query
                                ->where('approved', 1)
                                ->where('level', 1)
                                ->orWhere('approved', 0)
                                ->where('level', 2);
                        })
                            ->latest()
                            ->paginate(3);
                        
                        $loanCountKetua = App\Models\Loan::whereHas('loanApproval', function ($query) {
                            $query
                                ->where('approved', 1)
                                ->where('level', 1)
                                ->orWhere('approved', 0)
                                ->where('level', 2);
                        })->count();
                    @endphp
                    <li class="nav-item dropdown">
                        <a class="nav-link" data-toggle="dropdown" href="#">
                            <i class="fas fa-bell"></i>
                            <span class="badge badge-danger navbar-badge">{{ $loanCountKetua }}</span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <span class="dropdown-header">Notifications</span>
                            <div class="dropdown-divider"></div>
                            @forelse ($notificationKetua as $notifKetua)
                                <a href="{{ route('admin.loans.show', $notifKetua->id) }}" class="dropdown-item">
                                    Pengajuan Baru - <i class="fas fa-clock"></i>
                                    {{ $notifKetua->created_at->diffForHumans() }}
                                    <br>
                                    <small>
                                        <i class="fas fa-user"></i> {{ $notifKetua->studentParent->user->name }}
                                    </small>
                                </a>
                            @empty
                                <p class="dropdown-item">
                                    Belum ada notifikasi
                                </p>
                            @endforelse
                        </div>
                    </li>
                @endcan

                <!-- Notifications Dropdown Menu -->
                @can('create_pinjaman')
                    <li class="nav-item dropdown">
                        <a class="nav-link" data-toggle="dropdown" href="#">
                            <i class="fa fa-user-circle" aria-hidden="true"></i>
                        </a>
                        @php
                            $getId = Auth::user()->id;
                        @endphp
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <span class="dropdown-header">User Profile</span>
                            <div class="dropdown-divider"></div>
                            <a href="{{ route('admin.parent.get-profile', $getId) }}" class="dropdown-item">
                                <i class="fas fa-pencil-alt"></i> Update Profile
                            </a>

                            <div class="dropdown-divider"></div>
                        </div>
                    </li>
                @endcan


                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="#" class="brand-link">
                <img src="{{ asset('adminLTE/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">{{ env('APP_NAME') }}</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{ asset('adminLTE/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                            alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">{{ Auth::User()->name }} <small>🟢</small><br>
                            <small><i class="fas fa-user-circle"></i>
                                {{ Auth::user()->getRoleNames()->first() }}</small>
                        </a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                @include('partials.menuLTE')
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-12">
                            <h1 class="m-0">
                                @yield('title')
                            </h1>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                @yield('content')
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">
                made with ☕ to help your productivity
            </div>
            <!-- Default to the left -->
            <strong>Copyright <a href="{{ env('APP_AUTHOR_LINK') }}" target="_blank">
                    {{ env('APP_AUTHOR') }}</a> &copy;
                {{ date('Y') }} </strong> All
            rights
            reserved.
        </footer>
    </div>
    <form id="logoutform" action="{{ route('logout') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
    </form>
    <!-- ./wrapper -->
    <!-- jQuery -->
    <script src="{{ asset('adminLTE/plugins/jquery/jquery.min.js') }}"></script>
    <!-- REQUIRED SCRIPTS -->
    <script src="{{ asset('adminLTE/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('adminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('adminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('adminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('adminLTE/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('adminLTE/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>

    <!-- Bootstrap 4 -->
    <script src="{{ asset('adminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('adminLTE/dist/js/adminlte.min.js') }}"></script>
    <!-- SLEECT2 -->
    <!-- Select2 -->
    <script src="{{ asset('adminLTE/plugins/select2/js/select2.full.min.js') }}"></script>
    @yield('scripts')
</body>

</html>
