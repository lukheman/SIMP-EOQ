@extends('layouts.main')

@section('title', 'Kurir')

@section('sidebar-menu')
@include('kurir.menu')
@endsection

@section('content')
<div class="row">
    <div class="col-8">
        <div style="display: inline-block; transform: scaleX(-1); width: 100%;">
            <video width="100%" id="preview"></video>

        </div>
    </div>
    <div class="col-4" id="info-pesanan">
        <div class="form-group">
            <label for="tanggal">Tanggal Pesan</label>
            <input type="text" id="tanggal" class="form-control" readonly>
        </div>

        <div class="form-group">
            <label for="nama-pemesan">Nama Pemesan</label>
            <input type="text" id="nama-pemesan" class="form-control" readonly>
        </div>

        <div class="form-group">
            <label for="alamat">Alamat</label>
            <textarea name="" id="alamat" class="form-control" readonly></textarea>
        </div>

        <div class="form-group">
            <label for="total-harga">Total Harga</label>
            <input type="text" id="total-harga" class="form-control" readonly>
        </div>

        <div class="form-group">
            <button class="btn btn-sm btn-secondary w-100" id="btn-detail-transaksi" data-toggle="modal"
                data-target="#modal-detail-transaksi"> 
                <i class="fas fa-info-circle"></i>
                Detail Pesanan</button>
        </div>

    </div>

</div>

<div class="modal fade show" id="modal-detail-transaksi" style="display: none;" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Detail Pesanan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered" id="table-detail-transaksi">
                    <thead>
                        <tr>
                            <th style="width: 10px">No</th>
                            <th>Nama Produk</th>
                            <th>Jumlah</th>
                            <th>Harga Satuan</th>
                            <th>Total Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer justify-content-between">
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
@endsection

@section('custom-script')

<script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>

<script>

    let scanner = new Instascan.Scanner({video: document.getElementById('preview')});

    scanner.addListener('scan', function (content) {

        $.ajax({
            url: `{{ route('transaksi.update', '')}}/${content}`,
            method: 'PUT',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {status: 'dibayar'},
            success: function (data) {

                let infoPesanan = $('#info-pesanan');

                if (data.success) {

                    Swal.fire({
                        title: data.message,
                        icon: 'success'
                    });


                    let transaksi = data.data;
                    console.log(transaksi);

                    infoPesanan.find('#tanggal').val(transaksi.tanggal);
                    infoPesanan.find('#nama-pemesan').val(transaksi.user.name);
                    infoPesanan.find('#alamat').val(transaksi.user.reseller_detail.alamat);
                    infoPesanan.find('#total-harga').val(formatRupiah(transaksi.total_harga));
                    infoPesanan.find('#btn-detail-transaksi').attr('data-id-transaksi', transaksi.id);

                }

            },
            error: function (error) {
                console.log(error);
                Swal.fire({
                    title: 'Terjadi kesalahan',
                    icon: 'error',
                    text: 'Silakan coba lagi atau hubungi administrator.',
                });
            }
        });

    });

    $('#btn-detail-transaksi').click(function () {

        let idTransaksi = $(this).data('id-transaksi');

        $.ajax({
            url: '{{route('transaksi.detail')}}',
            method: 'POST',
            data: {
                'id_transaksi': idTransaksi
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
                if (data.success) {

                    $("#table-detail-transaksi tbody").empty();
                    data.data.forEach((item, index) => {
                        let newRow = `
                                <tr>
                                    <td>${index + 1}</td>
                                    <td>${item.produk.nama_produk}</td>
                                    <td>${item.jumlah}</td>
                                    <td>${formatRupiah(item.produk.harga_jual)}</td>
                                    <td>${formatRupiah(item.total_harga)}</td>
                                </tr>`;
                        $("#table-detail-transaksi tbody").append(newRow);
                    });
                }
            },
            error: function (error) {
                console.log(error);
            },
        });

    });

    Instascan.Camera.getCameras().then(function (cameras) {
        if (cameras.length > 1) {
            scanner.start(cameras[2]); // Menggunakan kamera belakang
        } else if (cameras.length > 0) {
            scanner.start(cameras[0]); // Jika hanya ada satu kamera
        } else {
            console.error('Tidak ada kamera yang terdeteksi.');
        }
    }).catch(function (e) {
        console.error(e);
    });

</script>
@endsection
