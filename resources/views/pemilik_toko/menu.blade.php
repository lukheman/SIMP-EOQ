<li class="nav-item">
    <a href="{{ route('pemiliktoko.dashboard') }}" class="nav-link {{ $page === 'Dashboard' ? 'active' : '' }}">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p> Dashboard </p>
    </a>
</li>

<li class="nav-header">LAPORAN</li>

<li class="nav-item">
    <a href="{{ route('pemiliktoko.laporan-penjualan') }}"
        class="nav-link  {{ $page === 'Laporan Penjualan' ? 'active' : '' }}"> <i class="fas fa-clipboard-list nav-icon"></i>
        <p>Penjualan</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('pemiliktoko.laporan-persediaan-produk') }}" class="nav-link {{
        $page==='Laporan Persediaan Produk' ? 'active' : '' }} "> 
        <i class="fas fa-boxes nav-icon"></i>
        <p>Persediaan Produk</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('pemiliktoko.laporan-barang-masuk') }}"
        class="nav-link  {{ $page === 'Laporan Barang Masuk' ? 'active' : '' }}">
        <i class="fas fa-box-open nav-icon"></i>
        <p>Barang Masuk</p>
    </a>
</li>
