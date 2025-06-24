@extends('layouts.main')

@section('title', 'Admin Gudang')

@section('sidebar-menu')

@include('admin_gudang.menu')

@endsection

@section('content')
<div class="card">
    <div class="card-header">

        <button class="btn btn-outline-primary" type="button" data-toggle="modal" data-target="#modal-scan-barcode"
            id="btn-add-mutasi"> <i class="fas fa-barcode"></i> Scan Barcode</button>
    </div>
    <div class="card-body">
        <div id="datatable_wrapper" class="dataTables_wrapper dt-bootstrap4">
            <div class="row">
                <div class="col-sm-12 col-md-6">

                </div>
                <div class="col-sm-12 col-md-6">

                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <table id="datatable" class="table table-bordered table-striped dataTable dtr-inline"
                        aria-describedby="datatable_info">
                        <thead>
                            <tr>
                                <th>Tanggal </th>
                                <th>Jenis Produk </th>
                                <th>Jumlah Dipesan</th>
                                <th>Harga Satuan (Rp.)</th>
                                <th>Total Harga (Rp.)</th>
                                <th>Aksi</th> </tr>
                        </thead>
                        <tbody>

                            @foreach ($barang_masuk as $item)
                            <tr>
                                <td> {{ $item->tanggal }}</td>
                                <td> {{ $item->produk->nama_produk }}</td>
                                <td> {{ $item->jumlah }}</td>
                                <td> {{ number_format($item->produk->harga_beli, 2, ',', '.') }}</td>
                                <td> {{ number_format($item->total_harga_beli, 2, ',', '.') }}</td>
                                <td>
                                    <button class="btn btn-sm btn-warning text-white btn-update-mutasi"
                                        data-id-mutasi="{{ $item->id }}" data-toggle="modal"
                                        data-target="#modal-update-mutasi">
                                        <i class="fas fa-edit"> </i>
                                        Edit</button>
                                    <button class="btn btn-sm btn-danger btn-delete-mutasi"
                                        data-id-mutasi="{{ $item->id }}">
                                        <i class="fas fa-trash"> </i>
                                        Hapus</button>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                        <tfoot>

                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-5">
                </div>
                <div class="col-sm-12 col-md-7">
                    <div class="dataTables_paginate paging_simple_numbers" id="datatable_paginate">
                        <ul class="pagination">
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade show" id="modal-scan-barcode" style="display: none;" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Scan Barcode</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="scanner"></div>
            </div>
        </div>
    </div>
</div>

<!-- modal-add-mutasi - modal untuk menampilkan form tambah data produk -->
<div class="modal fade show" id="modal-add-mutasi" style="display: none;" aria-modal="true" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Persediaan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form id="form-add-mutasi">
                @csrf
                <div class="modal-body">

                    <input type="hidden" name="jenis" value="masuk">

                    <input type="hidden" name="id_produk" id="id-produk">

                    <div class="form-group">
                        <label for="kode-produk">Barcode Produk</label>
                        <input type="text" class="form-control" name="kode_produk" id="kode-produk">
                    </div>

                    <!-- <div class="form-group"> -->
                    <!--     <label for="tanggal">Tanggal</label> -->
                    <!--     <input type="date" name="tanggal" id="tanggal" class="form-control" required> -->
                    <!-- </div> -->

                    <div class="form-group">
                        <label for="nama-produk">Nama Produk</label>
                        <input type="text" class="form-control" name="nama_produk" id="nama-produk"
                            placeholder="Nama Produk" readonly>
                    </div>

                    <div class="form-group">
                        <label for="jumlah">Jumlah</label>
                        <input type="number" name="jumlah" id="jumlah" class="form-control" min="1" required>
                    </div>

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"> </i>
                        Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- end modal-add-mutasi -->

<!-- modal-update-mutasi - modal untuk menampilkan form tambah data produk -->
<div class="modal fade show" id="modal-update-mutasi" style="display: none;" aria-modal="true" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Update Persediaan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form id="form-update-mutasi">
                @csrf
                <div class="modal-body">

                    <!-- <input type="hidden" name="jenis" value="masuk"> -->

                    <input type="hidden" id="id-mutasi" disabled>

                    <div class="form-group">
                        <label for="tanggal">Tanggal</label>
                        <input type="date" name="tanggal" id="tanggal" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="jumlah">Jumlah</label>
                        <input type="number" name="jumlah" id="jumlah" class="form-control" min="1" required>
                    </div>


                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="text-white btn btn-warning">
                    <i class="fas fa-save"> </i>
                    Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- end modal-update-mutasi -->
@endsection

@section('custom-script')
<script>

    $(document).ready(function () {
        $('#form-add-mutasi').on('submit', function (e) {
            e.preventDefault();

            $.ajax({
                url: '{{ route('mutasi.store') }}',
                method: 'POST',
                data: $(this).serialize(),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    showToast(data.message);
                },
                error: function (error) {
                    console.log(error);
                    Swal.fire({
                        title: 'Pesediaan gagal ditambahkan',
                        icon: "error",
                    }).then(() => window.location.reload());
                },
            })
        });


        // handler untuk mengupdate data
        $('#form-update-mutasi').on('submit', function (e) {
            e.preventDefault();

            let idMutasi = $('#id-mutasi').val();

            $.ajax({
                url: `{{ route('mutasi.update', '') }}/${idMutasi}`,
                method: 'PUT',
                data: $(this).serialize(),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    Swal.fire({
                        title: data.message,
                        icon: "success",
                    }).then(() => window.location.reload());
                },
                error: function (error) {
                    Swal.fire({
                        title: 'persediaan gagal diperbarui',
                        icon: "error",
                    }).then(() => window.location.reload());
                }
            });
        });

        // handle untuk update persediaan

        $('#datatable').on('click', '.btn-update-mutasi', function() {

            let idMutasi = $(this).data('id-mutasi');

            let formUpdateMutasi = $('#form-update-mutasi');

            $.ajax({
                url: `{{ route('mutasi.show', '') }}/${idMutasi}`,
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    let mutasi = data.data;

                    formUpdateMutasi.find('#id-mutasi').val(mutasi.id);
                    formUpdateMutasi.find('#tanggal').val(mutasi.tanggal);
                    formUpdateMutasi.find('#jumlah').val(mutasi.jumlah);

                },
                error: function (error) {
                    Swal.fire({
                        title: 'Produk gagal dihapus',
                        icon: "error",
                    }).then(() => window.location.reload());
                }
            });

        });


        // handler untuk menghapus data
        $('#datatable').on('click', '.btn-delete-mutasi', function() {

            let idMutasi = $(this).data('id-mutasi');

            // Confirm deletion with SweetAlert
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Persediaan akan dihapus secara permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {

                if (result.isConfirmed) {
                    $.ajax({
                        url: `{{ route('mutasi.destroy', '') }}/${idMutasi}`,
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (data) {
                            showToast('Data barang masuk berhasil dihapus.');
                        },
                        error: function (error) {
                            Swal.fire({
                                title: 'Data barang masuk gagal dihapus.',
                                icon: "error",
                            }).then(() => window.location.reload());
                        }
                    });
                }
            });

        });


    });



</script>

<script src="https://cdn.jsdelivr.net/npm/quagga@0.12.1/dist/quagga.min.js"></script>

<script>
// Fungsi untuk mulai scan barcode
function startScanner() {
    Quagga.init({
        inputStream: {
            type: "LiveStream",
            target: document.querySelector('#scanner'), // Menampilkan stream kamera di elemen ini
            constraints: {
                facingMode: "environment" // Menggunakan kamera belakang (untuk perangkat mobile)
            }
        },
        decoder: {
            readers: ["code_128_reader", "ean_reader", "upc_reader"]
        }
    }, function(err) {
            if (err) {
                console.error(err);
                return;
            }
            Quagga.start(); // Memulai pemindaian
        });

    // Event listener untuk mendapatkan hasil pemindaian
    Quagga.onDetected(function(result) {
        const barcode = result.codeResult.code;

        Quagga.stop();

        // cek apakah produk telah di pesan dan ada di table restock
        $.ajax({
            url: `{{ route('restock.exist', ':code') }}`.replace(':code', barcode), // Dynamically insert barcode
            method: 'GET',
            success: function(data) {
                if (data.success) {

                    $.ajax({
                        url: `{{ route('produk.kode-produk', ':code') }}`.replace(':code', barcode), // Dynamically insert barcode
                        method: 'GET',
                        success: function(data) {
                            if (data.success) {
                                data = data.data;


                                $('#modal-scan-barcode').modal('hide');
                                $('#modal-add-mutasi').modal('show');

                                $('#kode-produk').val(data.kode_produk);
                                $('#nama-produk').val(data.nama_produk);
                                $('#id-produk').val(data.id);

                            } else {
                                showToast(data.message, icon='error', reload=false);
                            }
                        },
                        error: function (xhr) {
                            console.log('Request failed:', xhr.responseJSON);
                        }
                    });

                } else {
                    showToast(data.message, icon='error');
                }
            },
            error: function (xhr) {
                console.log('Request failed:', xhr.responseJSON);
            }
        });

        setTimeout(() => {

            startScanner();
        }, 500);


    });
}

// Mulai scanner
startScanner();
</script>
@endsection
