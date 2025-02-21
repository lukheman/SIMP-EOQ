<li class="nav-item">
    <a href="{{ route('admingudang.dashboard') }}" class="nav-link {{ $page === 'Dashboard' ? 'active' : '' }}">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        Dashboard
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('admingudang.log-persediaan')}}" class="nav-link {{ $page === 'Log Persediaan' ? 'active' : '' }}">
        <i class="nav-icon fas fa-th"></i>
        Log Persediaan
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('admingudang.persediaan')}}" class="nav-link {{ $page === 'Persediaan' ? 'active' : '' }}">
        <i class="nav-icon fas fa-th"></i>
        Persediaan Produk
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('admingudang.data-produk')}}" class="nav-link {{ $page === 'Data Produk' ? 'active' : '' }}">
        <i class="nav-icon fas fa-th"></i>
        Data Produk
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('admingudang.eoq')}}" class="nav-link {{ $page === 'EOQ' ? 'active' : '' }}">
        <i class="nav-icon fas fa-th"></i>
        EOQ
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('admingudang.pesanan')}}" class="nav-link {{ $page === 'Pesanan' ? 'active' : '' }}">
        <i class="nav-icon fas fa-th"></i>
        Pesanan
    </a>
</li>
