<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand mt-3">
            <a href="">{{ config('app.name') }}</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="#">{{ strtoupper(substr(config('app.name'), 0, 2)) }}</a>
        </div>
        <ul class="sidebar-menu">
            @if (Auth::check() && Auth::user()->roles == 'admin')
            <li class="{{ request()->routeIs('admin.dashboard.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.dashboard') }}"><i class="fas fa-columns"></i> <span>Dashboard</span></a></li>
            <li class="menu-header">Master Data</li>

            <li class="{{ request()->routeIs('jurusan.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('jurusan.index') }}"><i class="fas fa-book"></i> <span>Jurusan</span></a></li>

            <li class="{{ request()->routeIs('mapel.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('mapel.index') }}"><i class="fas fa-book"></i> <span>Mata Pelajaran</span></a></li>

            <li class="{{ request()->routeIs('guru.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('guru.index') }}"><i class="fas fa-user"></i> <span>Guru</span></a></li>

            <li class="{{ request()->routeIs('kelas.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('kelas.index') }}"><i class="far fa-building"></i> <span>Kelas</span></a></li>

            <li class="{{ request()->routeIs('siswa.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('siswa.index') }}"><i class="fas fa-users"></i> <span>Siswa</span></a></li>

            <li class="{{ request()->routeIs('jadwal.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('jadwal.index') }}"><i class="fas fa-calendar"></i> <span>Jadwal</span></a></li>

            <li class="{{ request()->routeIs('user.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('user.index') }}"><i class="fas fa-user"></i> <span>User</span></a></li>

            @elseif (Auth::check() && Auth::user()->roles == 'guru')
            <li class="{{ request()->routeIs('guru.dashboard.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('guru.dashboard') }}"><i class="fas fa-columns"></i> <span>Dashboard</span></a></li>
            <li class="menu-header">Master Data</li>
            <li class="{{ request()->routeIs('materi.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('materi.index') }}"><i class="fas fa-book"></i> <span>Materi</span></a></li>
            <li class="{{ request()->routeIs('tugas.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('tugas.index') }}"><i class="fas fa-list"></i> <span>Tugas</span></a></li>

            @elseif (Auth::check() && Auth::user()->roles == 'siswa')
            <li class="{{ request()->routeIs('siswa.dashboard.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('siswa.dashboard') }}"><i class="fas fa-columns"></i> <span>Dashboard</span></a></li>
            <li class="{{ request()->routeIs('materi.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('siswa.materi') }}"><i class="fas fa-book"></i> <span>Materi</span></a></li>
            <li class="{{ request()->routeIs('tugas.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('siswa.tugas') }}"><i class="fas fa-list"></i> <span>Tugas</span></a></li>

            @endif

        </ul>
    </aside>
</div>
