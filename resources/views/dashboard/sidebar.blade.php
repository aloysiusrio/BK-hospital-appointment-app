<div class="sidebar" >
    
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            <img src="{{ asset('assets/img/user.jpg') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
            <a href="{{ route('dashboard.index') }}" class="d-block">
                @auth
                    {{ Auth::user()->name }}
                    @if (Auth::user()->role == 'admin')
                        (Admin)
                    @endif
                    @if (Auth::user()->role == 'dokter')
                        (Dokter)
                    @endif
                    @if (Auth::user()->role == 'pasien')
                        ({{ Auth::user()->pasien->no_rm }})
                    @endif
                @endauth
            </a>
        </div>
    </div>
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false" >
            <li class="nav-item">
                <a href="{{ route('dashboard.index') }}"
                    class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}">
                    <i class="fas fa-tachometer-alt nav-icon"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            @auth
                @if (Auth::user()->role == 'pasien')
                    <li class="nav-item">
                        <a href="{{ route('dashboard.pasien.poli.index') }}" class="nav-link {{ Request::is('dashboard/pasien/poli') ? 'active' : '' }}">
                            <i class="fas fa-chart-line nav-icon"></i>
                            <p>Daftar Poli</p>
                        </a>
                    </li>
                @endif

                @if (Auth::user()->role == 'admin')
                    <li class="nav-item {{ Request::is('*dashboard/admin/users*') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                Kelola Pengguna                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('dashboard.admin.users.dokter.index') }}"
                                    class="nav-link  {{ Request::is('*dashboard/admin/users/dokter*') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Dokter</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('dashboard.admin.users.pasien.index') }}"
                                    class="nav-link  {{ Request::is('*dashboard/admin/users/pasien*') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Pasien</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-database"></i>
                            <p>
                                Kelola Data
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('dashboard.admin.obat.index') }}"
                                    class="nav-link  {{ Request::is('*dashboard/admin/obat*') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Obat</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('dashboard.admin.poli.index') }}"
                                    class="nav-link  {{ Request::is('*dashboard/admin/poli*') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Poli</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
                @if (Auth::user()->role == 'dokter')
                    <li class="nav-item">
                        <a href="{{ route('dashboard.dokter.jadwal.index') }}"
                            class="nav-link {{ Request::is('*dashboard/dokter/jadwal*') ? 'active' : '' }}">
                            <i class="fas fa-calendar-alt nav-icon"></i>
                            <p>Jadwal Praktek</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('dashboard.dokter.periksa.index') }}"
                            class="nav-link {{ Request::is('*dashboard/dokter/periksa*') ? 'active' : '' }}">
                            <i class="fas fa-stethoscope nav-icon"></i>
                            <p>Memeriksa Pasien</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('dashboard.dokter.riwayat.index') }}"
                            class="nav-link {{ Request::is('*dashboard/dokter/riwayat*') ? 'active' : '' }}">
                            <i class="fas fa-history nav-icon"></i>
                            <p>Riwayat Pasien</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('dashboard.dokter.profil.edit') }}"
                            class="nav-link {{ Request::is('*dashboard/dokter/profil/edit*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-user"></i>
                            <p>Profile</p>
                        </a>
                    </li>
                @endif
            @endauth
        </ul>
    </nav>
</div>
