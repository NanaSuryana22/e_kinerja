<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <div class="d-flex justify-content-between">
                <div class="logo">
                    <a href="#" class="logosidebar"><b>E- <span>KINERJA</span></b></a>
                </div>
                <div class="toggler">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-title">Menu Utama</li>

                <li class="sidebar-item @yield('home')">
                    <a href="{{ route('halaman_utama.index') }}" class='sidebar-link'>
                        <i class="bi bi-grid-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="sidebar-item @yield('laporan_kinerja')">
                    <a href="{{ route('laporan_kinerja.index') }}" class='sidebar-link'>
                        <i class="bi bi-file-earmark-medical-fill"></i>
                        <span>Laporan Kinerja</span>
                    </a>
                </li>

                @if(auth()->user()->role == 'admin')
                    <li class="sidebar-title">Data Master</li>

                    <li class="sidebar-item @yield('jabatan')">
                        <a href="{{ route('jabatan.index') }}" class='sidebar-link'>
                            <i class="bi bi-briefcase-fill"></i>
                            <span>Master Jabatan</span>
                        </a>
                    </li>

                    <li class="sidebar-item @yield('pegawai')">
                        <a href="{{ route('pegawai.index') }}" class='sidebar-link'>
                            <i class="bi bi-people-fill"></i>
                            <span>Master Pegawai</span>
                        </a>
                    </li>

                    <li class="sidebar-item @yield('tugas_jabatan')">
                        <a href="{{ route('tugas_jabatan.index') }}" class='sidebar-link'>
                            <i class="bi bi-list-check"></i>
                            <span>Master Tugas Jabatan</span>
                        </a>
                    </li>
                @endif
                
                <li class="sidebar-item">
                    <a href="#" class='sidebar-link text-danger' 
                       onclick="event.preventDefault(); if(confirm('Yakin ingin keluar?')) document.getElementById('logout-form').submit();">
                        <i class="bi bi-box-arrow-right" style="color: #dc3545;"></i>
                        <span>Logout</span>
                    </a>
                </li>
            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>