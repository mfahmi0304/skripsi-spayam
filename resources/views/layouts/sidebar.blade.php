<a href="#" class="brand-link">
    <span class="brand-text font-weight-light">Sistem Pakar Ayam Bangkok</span>
</a>
<div class="sidebar">
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            <img src="{{ asset('dist/img/avatar5.png') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
            <a href="#" class="d-block">{{Auth::user()->name}}</a>
            <a href="#"><i class="fas fa-circle text-success fa-xs"></i> Online</a>
        </div>
    </div>
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-header">MENU UTAMA</li>
            <li class="nav-item">
                <a href="{{ route('home') }}" class="nav-link">
                    <i class="nav-icon fas fa-home"></i>
                    <p>Beranda</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="/gejala" class="nav-link">
                    <i class="fas fa-thermometer-half nav-icon"></i>
                    <p>Gejala</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="/penyakit" class="nav-link">
                    <i class="fas fa-bug nav-icon"></i>
                    <p>Penyakit</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="/basis_pengetahuan" class="nav-link">
                    <i class="fas fa-lightbulb nav-icon"></i>
                    <p>Basis Pengetahuan</p>
                </a>
            </li>
        </ul>
    </nav>
</div>