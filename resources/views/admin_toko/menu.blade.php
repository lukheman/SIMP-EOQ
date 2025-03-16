<li class="nav-item">
    <a href="{{ route('admintoko.index' )}}" class="nav-link {{ $page === 'Dashboard' ? 'active' : '' }}">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>Dashboard</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('admintoko.persediaan')}}" class="nav-link {{ $page === 'Persediaan' ? 'active' : '' }}">
        <i class="nav-icon fas fa-boxes"></i>
        <p>Persediaan Barang</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('admintoko.pesanan') }}" class="nav-link {{ $page === 'Pesanan' ? 'active' : '' }}">
        <i class="nav-icon fas fa-clipboard"></i>
        <p>Pesanan</p>
    </a>
</li>

<li class="nav-header">LAPORAN</li>

<li class="nav-item">
    <a href="{{ route('admintoko.laporan-penjualan') }}"
        class="nav-link  {{ $page === 'Laporan Penjualan' ? 'active' : '' }}">
        <i class="fas fa-chart-bar nav-icon"></i>
        <p>Penjualan</p>
    </a>
</li>
