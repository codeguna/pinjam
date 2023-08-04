<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
with font-awesome or any other icon font library -->
        <li class="nav-item">
            <a href="{{ route('admin.home') }}"
                class="nav-link {{ request()->is('admin/home') || request()->is('admin/home/*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-th"></i>
                <p>
                    Dashboard
                </p>
            </a>
        </li>
        @can('create_pinjaman')
            <li class="nav-item">
                <a href="{{ route('admin.loans.create') }}"
                    class="nav-link {{ request()->is('admin/loans/create') || request()->is('admin/loans/create/*') ? 'active' : '' }}">
                    <i class="fas fa-paper-plane nav-icon"></i>
                    <p>
                        Ajukan Pinjaman
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.loans.index') }}"
                    class="nav-link {{ request()->is('admin/loans') || request()->is('admin/loans/*') ? 'active' : '' }}">
                    <i class="fas fa-hand-holding-usd nav-icon"></i>
                    <p>
                        Pinjaman Saya
                    </p>
                </a>
            </li>
        @endcan

        @canany(['approval_pinjaman_ketua', 'approval_pinjaman_bendahara'])
            <li class="nav-item {{ request()->is('admin/loans/*') || request()->is('admin/loans') ? 'menu-open' : '' }}">
                <a href="#"
                    class="nav-link {{ request()->is('admin/loans/*') || request()->is('admin/loans') ? 'active' : '' }}">
                    <i class="fas fa-money-bill nav-icon"></i>
                    <p>
                        Data Peminjaman
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('admin.loans.index') }}"
                            class="nav-link {{ request()->is('admin/loans') || request()->is('admin/loans/*') ? 'active' : '' }}">
                            <i class="fas fa-door-open nav-icon"></i>
                            <p>Pinjaman Masuk</p>
                        </a>
                    </li>
                </ul>
            </li>
        @endcanany

        @can('data_master_manage')
            <li
                class="nav-item {{ request()->is('admin/class-rooms') ||
                request()->is('admin/class-rooms/*') ||
                request()->is('admin/students/*') ||
                request()->is('admin/students') ||
                request()->is('admin/parents/*') ||
                request()->is('admin/parents')
                    ? 'menu-open'
                    : '' }}">
                <a href="#"
                    class="nav-link {{ request()->is('admin/class-rooms/*') ||
                    request()->is('admin/class-rooms') ||
                    request()->is('admin/students/*') ||
                    request()->is('admin/students') ||
                    request()->is('admin/parents/*') ||
                    request()->is('admin/parents')
                        ? 'active'
                        : '' }}">
                    <i class="fa fa-archive nav-icon" aria-hidden="true"></i>
                    <p>
                        Data Master
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('admin.class-rooms.index') }}"
                            class="nav-link {{ request()->is('admin/class-rooms') || request()->is('admin/class-rooms/*') ? 'active' : '' }}">
                            <i class="fas fa-door-open nav-icon"></i>
                            <p>Class Rooms</p>
                        </a>
                    </li>
                </ul>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('admin.parents.index') }}"
                            class="nav-link {{ request()->is('admin/parents') || request()->is('admin/parents/*') ? 'active' : '' }}">
                            <i class="fas fa-user-plus nav-icon"></i>
                            <p>Parents</p>
                        </a>
                    </li>
                </ul>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('admin.students.index') }}"
                            class="nav-link {{ request()->is('admin/students') || request()->is('admin/students/*') ? 'active' : '' }}">
                            <i class="fas fa-user-graduate nav-icon"></i>
                            <p>Students</p>
                        </a>
                    </li>
                </ul>
            </li>
        @endcan

        @can('users_manage')
            <li
                class="nav-item {{ request()->is('admin/roles/*') ||
                request()->is('admin/roles') ||
                request()->is('admin/permissions') ||
                request()->is('admin/permissions/*') ||
                request()->is('admin/users') ||
                request()->is('admin/users/*')
                    ? 'menu-open'
                    : '' }}">
                <a href="#"
                    class="nav-link {{ request()->is('admin/roles/*') ||
                    request()->is('admin/roles') ||
                    request()->is('admin/permissions') ||
                    request()->is('admin/permissions/*') ||
                    request()->is('admin/users') ||
                    request()->is('admin/users/*')
                        ? 'active'
                        : '' }}">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        Users Management
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('admin.permissions.index') }}"
                            class="nav-link {{ request()->is('admin/permissions') || request()->is('admin/permissions/*') ? 'active' : '' }}">
                            <i class="far fas fa-unlock-alt nav-icon"></i>
                            <p>Permissions</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.roles.index') }}"
                            class="nav-link {{ request()->is('admin/roles') || request()->is('admin/roles/*') ? 'active' : '' }}">
                            <i class="far fas fa-briefcase nav-icon"></i>
                            <p>Roles</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.users.index') }}"
                            class="nav-link {{ request()->is('admin/users') || request()->is('admin/users/*') ? 'active' : '' }}">
                            <i class="far fas fa-user nav-icon"></i>
                            <p>Users</p>
                        </a>
                    </li>
                </ul>
            </li>
        @endcan
        <li class="nav-item">
            <a href="#" class="nav-link"
                onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                <i class="nav-icon fas fa-sign-out-alt"></i>
                <p>
                    Logout
                </p>
            </a>
        </li>
    </ul>
</nav>
