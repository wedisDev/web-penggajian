<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <img src="https://www.freepnglogos.com/uploads/google-logo-png/google-logo-png-suite-everything-you-need-know-about-google-newest-0.png" class="img-fluid" width="40px" alt="">
        </div>
        <div class="sidebar-brand-text mx-3">Kantin Tante</div>
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
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                        aria-expanded="true" aria-controls="collapseTwo">
                        <i class="fas fa-fw fa-cog"></i>
                        <span>Master</span>
                    </a>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Master Owner:</h6>
                            <a class="collapse-item" href="{{ route('golongan.index') }}"><i class="fas fa-user-friends fa-chart-area"></i> Golongan</a>
                            <a class="collapse-item" href="{{ url('/jabatan') }}"><i class="fas fa-handshake fa-chart-area"></i> Jabatan</a>
                            <a class="collapse-item" href="{{ url('/cabang') }}"><i class="fas fa-store fa-chart-area"></i> Cabang</a>
                            <a class="collapse-item" href="{{ url('/pegawai') }}"><i class="fas fa-users fa-chart-area"></i> Pegawai</a>
                            <a class="collapse-item" href="{{ url('/bonus-omzet') }}"><i class="fas fa-money-bill-wave fa-chart-area"></i> Bonus Omzet</a>
                        </div>
                    </div>
                </li>
        
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/pilih-cabang') }}">
                        <i class="fas fa-cash-register fa-chart-area"></i>
                        <span>transaksi</span></a>
                </li>
        
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/gaji-pegawai') }}">
                        <i class="far fa-money-bill-alt fa-chart-area"></i>
                        <span>Gaji Pegawai</span></a>
                </li>
    @elseif (Auth::user()->role == 'owner')
        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-cog"></i>
                <span>Master</span>
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Master Owner:</h6>
                    <a class="collapse-item" href="{{ route('golongan.index') }}"><i class="fas fa-user-friends fa-chart-area"></i> Golongan</a>
                    <a class="collapse-item" href="{{ url('/jabatan') }}"><i class="fas fa-handshake fa-chart-area"></i> Jabatan</a>
                    <a class="collapse-item" href="{{ url('/cabang') }}"><i class="fas fa-store fa-chart-area"></i> Cabang</a>
                    <a class="collapse-item" href="{{ url('/pegawai') }}"><i class="fas fa-users fa-chart-area"></i> Pegawai</a>
                    <a class="collapse-item" href="{{ url('/bonus-omzet') }}"><i class="fas fa-money-bill-wave fa-chart-area"></i> Bonus Omzet</a>
                </div>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ url('/pilih-cabang') }}">
                <i class="fas fa-cash-register fa-chart-area"></i>
                <span>transaksi</span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ url('/gaji-pegawai') }}">
                <i class="far fa-money-bill-alt fa-chart-area"></i>
                <span>Gaji Pegawai</span></a>
        </li>
    @elseif(Auth::user()->role == 'pegawai')
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/pelanggaran') }}">
                <i class="fas fa-exclamation-circle"></i>
                <span>Pelanggaran Pegawai</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/pegwai/rincian-gaji') }}">
                <i class="fas fa-money-bill-wave"></i>
                <span>Rincian gaji Pegawai</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/history') }}">
                <i class="fas fa-history"></i>
                <span>History Rincian Pegawai</span></a>
        </li>
    @endif

</ul>
<!-- End of Sidebar -->
