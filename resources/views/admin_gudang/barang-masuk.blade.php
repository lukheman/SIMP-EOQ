@extends('layouts.main')

@section('title', 'Admin Gudang')

@section('sidebar-menu')

@include('admin_gudang.menu')

@endsection

@section('content')
<div class="card">
    <div class="card-header">

        <button class="btn btn-outline-primary" type="button" data-toggle="modal" data-target="#modal-add-mutasi"
            id="btn-add-mutasi"> 
            <i class="fas fa-plus"></i>
            Tambah Barang Masuk</button>
    </div>
    <div class="card-body">
        <div id="table_persediaan_wrapper" class="dataTables_wrapper dt-bootstrap4">
            <div class="row">
                <div class="col-sm-12 col-md-6">

                </div>
                <div class="col-sm-12 col-md-6">

                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <table id="table_persediaan" class="table table-bordered table-striped dataTable dtr-inline"
                        aria-describedby="table_persediaan_info">
                        <thead>
                            <tr>
                                <th class="sorting sorting_asc" tabindex="0" aria-controls="table_pesanan" rowspan="1"
                                    colspan="1" aria-sort="ascending">Tanggal
                                </th>
                                <th class="sorting sorting_asc" tabindex="0" aria-controls="table_pesanan" rowspan="1"
                                    colspan="1" aria-sort="ascending">Jenis Produk
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="table_pesanan" rowspan="1" colspan="1">
                                    Jumlah</th>
                                <th class="sorting" tabindex="0" aria-controls="table_pesanan" rowspan="1" colspan="1">
                                    Total Harga (Rp.)</th>
                                <th class="sorting" tabindex="0" aria-controls="table_pesanan" rowspan="1" colspan="1">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($barang_masuk as $item)
                            <tr>
                                <td> {{ $item->tanggal }}</td>
                                <td> {{ $item->produk->nama_produk }}</td>
                                <td> {{ $item->jumlah }}</td>
                                <td> {{ number_format($item->total_harga_jual, 2, ',', '.') }}</td>
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
                    <div class="dataTables_paginate paging_simple_numbers" id="table_persediaan_paginate">
                        <ul class="pagination">
                        </ul>
                    </div>
                </div>
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

                    <div class="form-group">
                        <label for="tanggal">Tanggal</label>
                        <input type="date" name="tanggal" id="tanggal" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="nama-produk">Nama Produk</label>
                        <select name="id_produk" id="nama-produk" class="form-control" required>
                        </select>
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
                        <label for="nama-produk">Nama Produk</label>
                        <select name="id_produk" id="nama-produk" class="form-control" required>
                        </select>
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
    $(function () {

        $('#table_persediaan').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });

    });
</script>

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
                    Swal.fire({
                        title: data.message,
                        icon: "success",
                    }).then(() => window.location.reload());
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

        $('#btn-add-mutasi').click(() => {

            let modalAddMutasi = $('#modal-add-mutasi');

            $.ajax({
                url: '{{ route('produk.all') }}',
                method: 'GET',
                success: function (data) {
                    $('#nama-produk').empty();
                    data.data.forEach((item) => {
                        modalAddMutasi.find('#nama-produk').append(new Option(`${item.kode_produk} | ${item.nama_produk}`, item.id))
                    });

                    const today = new Date().toISOString().split('T')[0]; // Format YYYY-MM-DD
                    modalAddMutasi.find('#tanggal').val(today);

                },
                error: function (error) {
                    console.log(error);
                }

            });
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

                    $.ajax({
                        url: '{{ route('produk.all') }}',
                        method: 'GET',
                        success: function (data) {
                            formUpdateMutasi.find('#nama-produk').empty();
                            data.data.forEach((item) => {
                                const option = new Option(`${item.kode_produk} | ${item.nama_produk}`, item.id);
                                if (item.id === mutasi.produk.id) {
                                    option.setAttribute('selected', 'selected');
                                }
                                formUpdateMutasi.find('#nama-produk').append(option);
                            });
                        },
                        error: function (error) {
                            console.log(error);
                        }
                    });

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
        $('.btn-delete-mutasi').click(function () {

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
                            Swal.fire({
                                title: 'Data barang masuk berhasil dihapus.',
                                icon: "success",
                            }).then(() => window.location.reload());
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
@endsection
