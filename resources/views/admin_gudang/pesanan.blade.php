@extends('layouts.main')

@section('title', 'Admin Gudang')

@section('sidebar-menu')

@include('admin_gudang.menu')

@endsection

@section('content')
<div class="card">
    <div class="card-header">

        <button class="btn btn-outline-primary" type="button" data-toggle="modal" data-target="#modal-pesanan" id="btn-modal-pesanan"> <i class="fas fa-plus"></i> Tambah Pesanan</button>

    </div>
    <div class="card-body">
        <div id="table_pesanan_wrapper" class="dataTables_wrapper dt-bootstrap4">
            <div class="row">
                <div class="col-sm-12 col-md-6">

                </div>
                <div class="col-sm-12 col-md-6">

                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <table id="table_pesanan" class="table table-bordered table-striped dataTable dtr-inline"
                        aria-describedby="table_pesanan_info">
                        <thead>
                            <tr class="text-center">
                                <th>Tanggal Pesan</th>
                                <th>Jenis Produk </th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($pesanan as $item)
                            <tr>
                                <td> {{ $item->tanggal_pesan }}</td>
                                <td> {{ $item->produk->nama_produk }}</td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-danger btn-delete-pesanan"
                                        data-id-pesanan="{{ $item->id }}">
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
                    <div class="dataTables_paginate paging_simple_numbers" id="table_pesanan_paginate">
                        <ul class="pagination">
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- modal-pesanan: modal untuk menampilkan form tambah pesanan -->
<div class="modal fade show" id="modal-pesanan" style="display: none;" aria-modal="true" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Persediaan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form id="form-add-pesanan">
                @csrf
                <div class="modal-body">

                    <div class="form-group">
                        <label for="nama-produk">Nama Produk</label>
                        <select class="form-control select2" name="id_produk" id="nama-produk"></select>
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
<!-- end modal-pesanan -->

@endsection

@section('custom-script')
<script>
$(function () {



    $('#table_pesanan').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
    });

});
</script>

<script>

$(document).ready(function () {

    $('#btn-modal-pesanan').click(function() {


        $.ajax({
            url: "{{ route('produk.index') }}",
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {

                // Kosongkan dulu isi <select> sebelum menambahkan opsi baru
                $('#nama-produk').empty().append('<option disabled selected>Pilih Produk</option>');

                $.each(data.data, function(index, produk) {
                    $('#nama-produk').append(
                        $('<option>', {
                            value: produk.id,
                            text: `${produk.kode_produk} | ${produk.nama_produk}`
                        })
                    );
                });

                // Jika pakai Select2, refresh tampilannya
                if ($.fn.select2) {
                    $('#nama-produk').trigger('change.select2');
                }

            },
            error: function (error) {
                console.log(error);
            },
        });
    });

    $('#form-add-pesanan').on('submit', function (e) {
        e.preventDefault();

        $.ajax({
            url: '{{ route('restock.store') }}',
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
    $('.btn-update-mutasi').click(function () {

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
    $('.btn-delete-pesanan').click(function () {

        let idRestock = $(this).data('id-pesanan');

        $.ajax({
            url: `{{ route('restock.destroy', ':id') }}`.replace(':id', idRestock),
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
                if(data.success) {
                    showToast(data.message);
                }
            },
            error: function (error) {
                Swal.fire({
                    title: 'Data barang masuk gagal dihapus.',
                    icon: "error",
                }).then(() => window.location.reload());
            }
        });

    });


});



</script>

@endsection
