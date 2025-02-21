<li class="nav-item">
    <a href="{{ route('kurir.dashboard') }}" class="nav-link {{ $page === 'Dashboard' ? 'active' : '' }}">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        Dashboard
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('kurir.konfirmasi-pembayaran') }}"
        class="nav-link {{ $page === 'Konfirmasi Pembayaran' ? 'active' : '' }}">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        Konfirmasi Pembayaran
    </a>
</li>
