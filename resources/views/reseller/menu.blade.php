<li class="nav-item">
    <a href="{{ route('reseller.dashboard') }}" class="nav-link {{ $page === 'Dashboard' ? 'active' : '' }}">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        Dashboard
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('reseller.katalog')}}" class="nav-link {{ $page === 'Katalog' ? 'active' : '' }}">
        <i class="nav-icon fas fa-th"></i>
        Katalog Produk
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('reseller.pesanan')}}" class="nav-link {{ $page === 'Pesanan' ? 'active' : '' }}">
        <i class="nav-icon fas fa-th"></i>
        Data Pesanan
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('reseller.pengiriman')}}" class="nav-link {{ $page === 'Pengiriman' ? 'active' : '' }}">
        <i class="nav-icon fas fa-th"></i>
        Pengiriman
    </a>
</li>
