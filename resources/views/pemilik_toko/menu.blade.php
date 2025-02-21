<li class="nav-item">
    <a href="{{ route('pemiliktoko.dashboard') }}" class="nav-link {{ $page === 'Dashboard' ? 'active' : '' }}">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        Dashboard
    </a>
</li>

<li class="nav-item">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-table"></i>
        <p>
            Laporan
            <i class="fas fa-angle-left right"></i>
        </p>
    </a>
    <ul class="nav nav-treeview" style="display: block;">
        <li class="nav-item">
            <a href="tables/simple.html" class="nav-link  {{ $page === 'Laporan Penjualan' ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Data Penjualan</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="tables/data.html" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Data Persediaan Produk</p>
            </a>
        </li>

    </ul>
</li>
