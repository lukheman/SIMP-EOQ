<li class="nav-item">
    <a href="{{ route('admingudang.dashboard') }}" class="nav-link {{ $page === 'Dashboard' ? 'active' : '' }}">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>Dashboard</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('admingudang.produk')}}" class="nav-link {{ $page === 'Produk' ? 'active' : '' }}">
        <i class="nav-icon fas fa-cubes"></i>
        <p> 
        Data Produk
        </p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('admingudang.persediaan')}}" class="nav-link {{ $page === 'Persediaan' ? 'active' : '' }}">
        <i class="nav-icon fas fa-boxes"></i>
        <p> 
        Persediaan Produk
        </p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('admingudang.barang-masuk')}}" class="nav-link {{ $page === 'Barang Masuk' ? 'active' : '' }}">
        <i class="nav-icon fas fa-box-open"></i>
        <p>
        Barang Masuk
</p>
    </a>
</li>



<li class="nav-item">
    <a href="{{ route('admingudang.eoq')}}" class="nav-link {{ $page === 'EOQ' ? 'active' : '' }}">
        <i class="nav-icon fas fa-calculator"></i>
        <p> 
        EOQ
        </p>
    </a>
</li>

<li class="nav-header">LAPORAN</li>

<li class="nav-item">
    <a href="{{ route('admingudang.laporan-barang-masuk') }}"
        class="nav-link  {{ $page === 'Laporan Barang Masuk' ? 'active' : '' }}">
        <i class="fas fa-box-open nav-icon"></i>
        <p>Barang Masuk</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('admingudang.laporan-penjualan') }}" class="nav-link  {{ $page === 'Laporan Penjualan' ? 'active' : '' }}">
        <i class="far fa-chart-bar nav-icon"></i>
        <p>Penjualan</p>
    </a>
</li>
