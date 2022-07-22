<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Penggajian</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ url('/dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Master
    </div>

    @if (Auth::user()->role == 'admin')
        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link" href="charts.html">
                <i class="fas fa-calculator fa-chart-area"></i>
                <span>Perhitungan</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="charts.html">
                <i class="fas fa-trophy fa-chart-area"></i>
                <span>Prestasi Pegawai</span></a>
        </li>
    @elseif (Auth::user()->role == 'owner')
        <li class="nav-item">
            <a class="nav-link" href="{{ route('golongan.index') }}">
                <i class="fas fa-user-friends fa-chart-area"></i>
                <span>Golongan</span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ url('/jabatan') }}">
                <i class="fas fa-handshake fa-chart-area"></i>
                <span>Jabatan</span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ url('/cabang') }}">
                <i class="fas fa-store fa-chart-area"></i>
                <span>Cabang</span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ url('/pegawai') }}">
                <i class="fas fa-users fa-chart-area"></i>
                <span>Pegawai</span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ url('/bonus-omzet') }}">
                <i class="fas fa-money-bill-wave fa-chart-area"></i>
                <span>Bonus Omzet</span></a>
        </li>

    @elseif(Auth::user()->role == 'pegawai')
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/') }}">
                <i class="fas fa-exclamation-circle"></i>
                <span>Pelanggaran Pegawai</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/') }}">
                <i class="fas fa-trophy"></i>
                <span>Perestasi Pegawai</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/pegwai/rincian-gaji') }}">
                <i class="fas fa-money-bill-wave"></i>
                <span>Rincian gaji Pegawai</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/') }}">
                <i class="fas fa-history"></i>
                <span>History Rincian Pegawai</span></a>
        </li>
    @endif

</ul>
<!-- End of Sidebar -->
