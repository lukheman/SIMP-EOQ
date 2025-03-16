@extends('layouts.main')

@section('title', 'Toko Kecil')

@section('sidebar-menu')
@include('reseller.menu')
@endsection

@section('content')
<div class="row">

    @foreach ($produk as $item)
    <div class="col-3">
        <div class="card">
            <div class="card-body">
                <div class="image">
                    <img src="{{ asset('storage/' . $item->gambar )}}" class="product-img" alt="{{ $item->nama_produk}}"
                        width="180">
                </div>
                <div class="row mt-2">
                    <div class="col-12">
                        <small>{{ $item->nama_produk }}</small>
                    </div>
                    <div class="col-12">
                        <p>Rp. {{ number_format($item->harga_jual, 2, ',', '.')}}</p>
                    </div>
                    <div class="col-12">
                        <p class="float-left">{{ $item->persediaan }}</p>
                        <button type="button" class="btn btn-sm btn-primary float-right btn-tambah-pesanan"
                            data-toggle="modal" data-target="#modal-tambah-pesanan" data-id-produk="{{ $item->id }}">
                            <i class="nav-icon fas fa-cart-plus"></i>
                        </button>
                    </div>

                </div>
            </div>
        </div>

    </div>

    @endforeach
</div>

<div class="modal fade show" id="modal-tambah-pesanan" style="display: none;" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Pemesanan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form id="form-tambah-pesanan">
                @csrf

                <input type="hidden" id="id-produk" name="id_produk">

                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <div class="image">
                                <img src="{{ asset('dist/img/prod-1.jpg')}}" class="product-img elevation-2"
                                    alt="User Image" width="200">
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="row">
                                <div class="col-12">
                                    <p id="nama-produk"></p>
                                    <p><small id="deskripsi-produk"></small></p>
                                    <p id="harga-jual"></p>

                                </div>
                                <div class="col-12">
                                    <div class="input-group" style="width: 130px;">
                                        <div class="input-group-prepend">
                                            <button type="button" class="btn btn-default" id="btn-kurang-jumlah">
                                                <i class="fas fa-minus"></i>
                                            </button>

                                        </div>
                                        <input type="text" name="jumlah" id="jumlah" class="form-control" value="1">
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-default" id="btn-tambah-jumlah">
                                                <i class="fas fa-plus"></i>
                                            </button>

                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">

                        <i class="nav-icon fas fa-cart-plus"></i>
                        Tambah Ke Keranjang</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
@endsection

@section('custom-script')
<script>

    $(document).ready(() => {

        $('#form-tambah-pesanan').on('submit', function (e) {
            e.preventDefault();

            $.ajax({
                url: "{{ route('pesanan.store') }}",
                method: "POST",
                data: $(this).serialize(),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    // TODO: jangan gunakan swetalert, cukup tampilakn notifikasi di kanan atas menggunakan fitur admin lte
                    Swal.fire({
                        title: data.message,
                        icon: "success",
                    }).then(() => window.location.reload());
                },
                error: function (error) {
                    Swal.fire({
                        title: 'Gagal melakukan pembelian',
                        icon: "error",
                    }).then(() => window.location.reload());
                }
            });
        });

        $('.btn-tambah-pesanan').click(function () {

            let modalTambahPesanan = $('#modal-tambah-pesanan');
            let idProduk = $(this).data('id-produk');

            $.ajax({
                url: `{{ route('produk.show', '') }}/${idProduk}`,
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    let produk = data.data;

                    // let formatRupiah = produk.harga_jual.toLocaleString("id-ID", {style: "currency", currency: "IDR"});

                    // console.log(produk);

                    modalTambahPesanan.find('#id-produk').val(produk.id);
                    modalTambahPesanan.find('#nama-produk').text(produk.nama_produk);
                    modalTambahPesanan.find('#harga-jual').text(formatRupiah(produk.harga_jual));
                    modalTambahPesanan.find('#deskripsi-produk').text(produk.deskripsi);

                },
                error: function (error) {
                    Swal.fire({
                        title: 'Produk gagal dihapus',
                        icon: "error",
                    }).then(() => window.location.reload());
                }
            });

        });

        $('#btn-tambah-jumlah').click(function () {
            let jumlah = parseInt($('#jumlah').val())
            $('#jumlah').val(jumlah + 1);
        });

        $('#btn-kurang-jumlah').click(function () {
            let jumlah = parseInt($('#jumlah').val())
            if (jumlah > 1) {
                $('#jumlah').val(jumlah - 1);
            }
        });

    });

</script>
@endsection
