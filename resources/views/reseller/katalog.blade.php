@extends('layouts.main')

@section('title', 'Toko Kecil')

@section('sidebar-menu')
@include('reseller.menu')
@endsection

@section('content')

<div class="row mb-3">

    <div class="col-12">
        <form action="{{ route('reseller.katalog')}}" method="get">

            <div class="input-group">
                <input type="text" class="form-control" name="q" value="{{ request('q') }}" placeholder="Cari produk">
                <span class="input-group-append">
                    <button type="submit" class="btn btn-info btn-flat">Cari</button>
                </span>
            </div>
        </form>
    </div>


</div>

<div class="row">

    @foreach ($produk as $item)
    <div class="col-12 col-md-3">
        <div class="card">
            <div class="card-body">
                <div class="position-relative" style="height: 180px; display: flex; align-items: center; justify-content: center; background: #f8f9fa; overflow: hidden;">
                    <img src="{{ asset('storage/' . $item->gambar) }}" class="img-fluid product-image" alt="{{ $item->nama_produk }}" style="max-height: 100%; object-fit: contain;">

                    @if ($item->persediaan->jumlah === 0)
                    <div class="position-absolute w-100 h-100 d-flex align-items-center justify-content-center" style="background: rgba(0,0,0,0.5);">
                        <span class="text-white font-weight-bold" style="font-size: 1.5rem;">Kosong</span>
                    </div>
                    @endif
                </div>

                <div class="row mt-2">
                    <div class="col-6"> {{ $item->nama_produk }} </div>
                    <div class="col-6 d-flex justify-content-end"> {{ $item->persediaan->jumlah }} </div>
                </div>

                <div class="row">
                    <div class="col-6">

                        <small>Rp. {{ number_format($item->harga_jual, 2, ',', '.') }}</small>

                    </div>
                    <div class="col-6 d-flex justify-content-end">
                        <small>Kadaluarsa pada {{ $item->exp }}</small>

                    </div>

                </div>

                <div class="row">

                    <div class="col-12">
                        <button type="button" class="btn btn-sm btn-primary float-right btn-tambah-pesanan"
                            data-toggle="modal" data-target="#modal-tambah-pesanan" data-id-produk="{{ $item->id }}" data-gambar-produk="{{ $item->gambar }}" {{ $item->persediaan->jumlah == 0 ? 'disabled' : '' }}>
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
                        <div class="col-12 col-sm-6 text-center">
                            <img class="img-fluid" width="200" height="10" id="img-gambar-produk">
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

                        <i class="nav-icon fas fa-cart-plus"></i> Tambah Ke Keranjang</button>
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
                if(data.success) {
                    showToast(data.message);
                } else {
                    showToast(data.message, icon='warning');
                }
                $('#modal-tambah-pesanan').modal('hide');
            },
            error: function (error) {
                showToast( 'Gagal melakukan pembelian', icon='error', reload=false);
            }
        });
    });

    $('.btn-tambah-pesanan').click(function () {

        let modalTambahPesanan = $('#modal-tambah-pesanan');
        let idProduk = $(this).data('id-produk');
        let gambarProduk = $(this).data('gambar-produk');

        const baseUrl = "{{ asset('storage') }}";
        $('#img-gambar-produk').attr('src', `${baseUrl}/${gambarProduk}`);

        $.ajax({
            url: `{{ route('produk.show', '') }}/${idProduk}`,
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
                let produk = data.data;

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
