<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/dashboard') }}">
                <i class="mdi mdi-grid-large menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/pages/Profil') }}">
                <i class="menu-icon mdi mdi-animation"></i>
                <span class="menu-title">Profil</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/pages/Profil') }}">
                <i class="menu-icon mdi mdi-animation"></i>
                <span class="menu-title">Lokasi</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#form-elements" aria-expanded="false"
                aria-controls="form-elements">
                <i class="menu-icon mdi mdi-cash-multiple"></i>
                <span class="menu-title">IoT</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="form-elements">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"><a class="nav-link" href="{{ url('/pages/PerkiraanIot') }}">IoT Sensor</a></li>
                </ul>
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"><a class="nav-link" href="{{ url('/pages/PerkiraanCuaca') }}">Perkiraan Cuaca #Dalam Pengembangan</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/pages/pemprosesan') }}">
                <i class="menu-icon mdi mdi-animation"></i>
                <span class="menu-title">Kegiatan Penanaman Bawang</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/pages/pemprosesan') }}">
                <i class="menu-icon mdi mdi-animation"></i>
                <span class="menu-title">Data Pestisida</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/pages/pemprosesan') }}">
                <i class="menu-icon mdi mdi-animation"></i>
                <span class="menu-title">Data Pupuk</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/pages/pemprosesan') }}">
                <i class="menu-icon mdi mdi-animation"></i>
                <span class="menu-title">Data Panen</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/pages/pemprosesan') }}">
                <i class="menu-icon mdi mdi-animation"></i>
                <span class="menu-title">Data Panen</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/pages/pemprosesan') }}">
                <i class="menu-icon mdi mdi-animation"></i>
                <span class="menu-title">Panen History</span>
            </a>
        </li>
    </ul>
</nav>
