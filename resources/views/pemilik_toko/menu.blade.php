<x-nav-link
    href="{{ route('pemiliktoko.dashboard') }}"
    :active="$page === 'Dashboard'"
    icon="fa-tachometer-alt">
    Dashboard
</x-nav-link>


<li class="nav-header">LAPORAN</li>

<x-nav-link
    href="{{ route('pemiliktoko.laporan-penjualan') }}"
    :active="$page === 'Laporan Penjualan'"
    icon="fa-clipboard-list">
    Penjualan
</x-nav-link>

<x-nav-link
    href="{{ route('pemiliktoko.laporan-persediaan-produk') }}"
    :active="$page === 'Laporan Persediaan Produk'"
    icon="fa-boxes">
    Persediaan Produk
</x-nav-link>

<x-nav-link
    href="{{ route('pemiliktoko.laporan-barang-masuk') }}"
    :active="$page === 'Laporan Barang Masuk'"
    icon="fa-box-open">
    Barang Masuk
</x-nav-link>
