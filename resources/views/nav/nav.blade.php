<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/dashboard') }}">
                <i class="mdi mdi-view-dashboard menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/pages/Profil') }}">
                <i class="menu-icon mdi mdi-account"></i>
                <span class="menu-title">Profil</span>
            </a>
        </li>
        <!-- <li class="nav-item">
            <a class="nav-link" href="{{ url('/pages/Profil') }}">
                <i class="menu-icon mdi mdi-file"></i>
                <span class="menu-title">Assessment</span>
            </a>
        </li> -->
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/viewlokasisawah/') }}">
                <i class="menu-icon mdi mdi-map-marker"></i>
                <span class="menu-title">Lokasi Sawah</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#form-elements" aria-expanded="false"
                aria-controls="form-elements">
                <i class="menu-icon mdi mdi-wifi"></i>
                <span class="menu-title">IoT</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="form-elements">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"><a class="nav-link" href="{{ url('/pages/PerkiraanIot') }}">IoT Sensor</a></li>
                </ul>
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"><a class="nav-link" href="{{ url('/viewperkiraancuaca/') }}">Perkiraan Cuaca</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/viewkegiatansawah/') }}">
                <i class="menu-icon mdi mdi-leaf"></i>
                <span class="menu-title">Penanaman Bawang</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/viewkegiatanpupuk/') }}">
                <i class="menu-icon mdi mdi-chemical-weapon"></i>
                <span class="menu-title">Kegiatan Pupuk</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/viewkegiatanpestisida/') }}">
                <i class="menu-icon mdi mdi-spray"></i>
                <span class="menu-title">Kegiatan Pestisida</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/viewpanen/') }}">
                <i class="menu-icon mdi mdi-sack"></i>
                <span class="menu-title">Panen</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/viewriwayatpanen') }}">
                <i class="menu-icon mdi mdi-history"></i>
                <span class="menu-title">Riwayat Panen</span>
            </a>
        </li>
    </ul>
</nav>
