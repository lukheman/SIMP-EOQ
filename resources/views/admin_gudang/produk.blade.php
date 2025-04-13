@extends('layouts.main')

@section('title', 'Admin Gudang')

@section('sidebar-menu')

@include('admin_gudang.menu')

@endsection

@section('content')
<div class="card">
    <div class="card-header">

        <button class="btn btn-outline-primary" type="button" data-toggle="modal" data-target="#modal-add-produk">
        <i class="fas fa-plus"></i>
            Tambah Produk</button>

    </div>
    <div class="card-body">
        <div id="table_produk_wrapper" class="dataTables_wrapper dt-bootstrap4">
            <div class="row">
                <div class="col-sm-12 col-md-6">


                </div>
                <div class="col-sm-12 col-md-6">

                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <table id="table_produk" class="table table-bordered table-striped dataTable dtr-inline"
                        aria-describedby="table_produk_info">
                        <thead>
                            <tr>
                                <th class="sorting sorting_asc" tabindex="0" aria-controls="table_produk" rowspan="1"
                                    colspan="1" aria-sort="ascending">Kode
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="table_produk" rowspan="1" colspan="1">
                                    Nama Produk</th>
                                <!-- <th class="sorting" tabindex="0" aria-controls="table_produk" rowspan="1" colspan="1"> -->
                                <!--     Harga Beli (Rp) -->
                                <!-- </th> -->
                                <!-- <th class="sorting" tabindex="0" aria-controls="table_produk" rowspan="1" colspan="1"> -->
                                <!--     Harga Jual (Rp) -->
                                <!-- </th> -->
                                <th class="sorting" tabindex="0" aria-controls="table_produk" rowspan="1" colspan="1">
                                    Biaya Penyimpanan (Rp)
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="table_produk" rowspan="1" colspan="1">
                                    Biaya Pemesanan (Rp)
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="table_produk" rowspan="1" colspan="1">
                                    Waktu Tunggu (Hari)
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="table_produk" rowspan="1" colspan="1">
                                    Penggunaan Rata-Rata (Hari)
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="table_produk" rowspan="1" colspan="1">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($produk as $item)
                            <tr>
                                <td> {{ $item->kode_produk }}</td>
                                <td> {{ $item->nama_produk }}</td>
                                <td> {{ number_format($item->biaya_penyimpanan, 0, ',', '.') }}</td>
                                <td> {{ number_format($item->biaya_pemesanan, 0, ',', '.') }}</td>
                                <td> {{ $item->lead_time }}</td>
                                <td> {{ $item->penggunaan_rata_rata }}</td>
                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-sm btn-info btn-info-produk" data-toggle="modal"
                                            data-target="#modal-info-produk" data-id-produk="{{ $item->id }}">
                                            <i class="fas fa-info"></i>
                                            Info</button>
                                        <button class="text-white btn btn-sm btn-warning btn-update-produk" data-toggle="modal"
                                            data-target="#modal-update-produk" data-id-produk="{{ $item->id }}">
                                            <i class="fas fa-edit"></i>
                                            Edit</button>
                                        <button class="btn btn-sm btn-danger btn-delete-produk"
                                            data-id-produk="{{ $item->id }}">
                                            <i class="fas fa-trash"></i>
                                            Hapus</button>
                                    </div>
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
                    <div class="dataTables_paginate paging_simple_numbers" id="table_produk_paginate">
                        <ul class="pagination">
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- modal-add-produk - modal untuk menampilkan form tambah data produk -->
<div class="modal fade show" id="modal-add-produk" style="display: none;" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Produk</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form id="form-add-produk">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="kode-produk">Kode Produk</label>
                                <input type="text" class="form-control" name="kode_produk" id="kode-produk">
                            </div>

                            <div class="form-group">
                                <label for="nama-produk">Nama Produk</label>
                                <input type="text" class="form-control" name="nama_produk" id="nama-produk"
                                    placeholder="Nama Produk">
                            </div>

                            <div class="form-group">
                                <label for="gambar">Gambar</label>
                                <input type="file" class="form-control" name="gambar" id="gambar">
                            </div>

                            <div class="form-group">
                                <label for="harga-jual">Harga Jual</label>
                                <input type="number" class="form-control" name="harga_jual" id="harga-jual"
                                    placeholder="Harga Jual" min="0">
                            </div>

                            <div class="form-group">
                                <label for="harga-beli">Harga Beli</label>
                                <input type="number" class="form-control" name="harga_beli" id="harga-beli"
                                    placeholder="Harga Beli" min="0">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="biaya-penyimpanan">Biaya Penyimpanan</label>
                                <input type="number" class="form-control" name="biaya_penyimpanan"
                                    id="biaya-penyimpanan" placeholder="Biaya Penyimpanan" min="0">
                            </div>

                            <div class="form-group">
                                <label for="biaya-pemesanan">Biaya Pemesanan</label>
                                <input type="number" class="form-control" name="biaya_pemesanan" id="biaya-pemesanan"
                                    placeholder="Biaya Pemesanan" min="0">
                            </div>

                            <div class="form-group">
                                <label for="lead-time">Waktu Tunggu (Hari)</label>
                                <input type="number" class="form-control" name="lead_time" id="lead-time"
                                    placeholder="Waktu Tunggu" min="0">
                            </div>

                            <div class="form-group">
                                <label for="penggunaan-rata-rata">Penggunaan Rata-Rata Harian</label>
                                <input type="number" class="form-control" name="penggunaan_rata_rata"
                                    id="penggunaan-rata-rata" placeholder="Penggunaan Rata-Rata Harian" min="0">
                            </div>

                            <div class="form-group">
                                <label for="deskripsi">Deskripsi</label>
                                <textarea class="form-control" name="deskripsi" id="deskripsi"
                                    placeholder="Deskripsi Produk"></textarea>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i>
                    Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- end modal-add-produk -->


<!-- modal-update-produk - modal untuk menampilkan form tambah data produk -->
<div class="modal fade show" id="modal-update-produk" style="display: none;" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Produk</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form id="form-update-produk">
                @csrf

                <input type="hidden" id="id-produk" disabled>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="kode-produk">Kode Produk</label>
                                <input type="text" class="form-control" name="kode_produk" id="kode-produk">
                            </div>

                            <div class="form-group">
                                <label for="nama-produk">Nama Produk</label>
                                <input type="text" class="form-control" name="nama_produk" id="nama-produk"
                                    placeholder="Nama Produk">
                            </div>

                            <div class="form-group">
                                <label for="gambar">Gambar</label>
                                <input type="file" class="form-control" name="gambar" id="gambar">
                            </div>

                            <div class="form-group">
                                <label for="harga-beli">Harga Beli</label>
                                <input type="number" class="form-control" name="harga_beli" id="harga-beli"
                                    placeholder="Harga Beli" min="0">
                            </div>

                            <div class="form-group">
                                <label for="harga-jual">Harga Jual</label>
                                <input type="number" class="form-control" name="harga_jual" id="harga-jual"
                                    placeholder="Harga Jual" min="0">
                            </div>


                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="biaya-penyimpanan">Biaya Penyimpanan</label>
                                <input type="number" class="form-control" name="biaya_penyimpanan"
                                    id="biaya-penyimpanan" placeholder="Biaya Penyimpanan" min="0">
                            </div>

                            <div class="form-group">
                                <label for="biaya-pemesanan">Biaya Pemesanan</label>
                                <input type="number" class="form-control" name="biaya_pemesanan" id="biaya-pemesanan"
                                    placeholder="Biaya Pemesanan" min="0">
                            </div>

                            <div class="form-group">
                                <label for="lead-time">Waktu Tunggu (Hari)</label>
                                <input type="number" class="form-control" name="lead_time" id="lead-time"
                                    placeholder="Waktu Tunggu" min="0">
                            </div>

                            <div class="form-group">
                                <label for="penggunaan-rata-rata">Penggunaan Rata-Rata Harian</label>
                                <input type="number" class="form-control" name="penggunaan_rata_rata"
                                    id="penggunaan-rata-rata" placeholder="Penggunaan Rata-Rata Harian" min="0">
                            </div>

                            <div class="form-group">
                                <label for="deskripsi">Deskripsi</label>
                                <textarea class="form-control" name="deskripsi" id="deskripsi"
                                    placeholder="Deskripsi Produk"></textarea>
                            </div>

                        </div>
                    </div>

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="text-white btn btn-warning">
                    <i class="fas fa-save"></i>
                    Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- end modal-update-produk -->

<!-- modal-info-produk - modal untuk menampilkan form tambah data produk -->
<div class="modal fade show" id="modal-info-produk" style="display: none;" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Info Produk</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-4">
                        <img src="" class="product-image" id="gambar-produk">
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="kode-produk">Kode Produk</label>
                            <input type="text" class="form-control" name="kode_produk" id="kode-produk" readonly>
                        </div>

                        <div class="form-group">
                            <label for="nama-produk">Nama Produk</label>
                            <input type="text" class="form-control" name="nama_produk" id="nama-produk"
                                placeholder="Nama Produk" readonly>
                        </div>

                        <div class="form-group">
                            <label for="harga-beli">Harga Beli</label>
                            <input type="number" class="form-control" name="harga_beli" id="harga-beli"
                                placeholder="Harga Beli" min="0" readonly>
                        </div>

                        <div class="form-group">
                            <label for="harga-jual">Harga Jual</label>
                            <input type="number" class="form-control" name="harga_jual" id="harga-jual"
                                placeholder="Harga Jual" min="0" readonly>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="biaya-penyimpanan">Biaya Penyimpanan</label>
                            <input type="number" class="form-control" name="biaya_penyimpanan" id="biaya-penyimpanan"
                                placeholder="Biaya Penyimpanan" min="0" readonly>
                        </div>

                        <div class="form-group">
                            <label for="biaya-pemesanan">Biaya Pemesanan</label>
                            <input type="number" class="form-control" name="biaya_pemesanan" id="biaya-pemesanan"
                                placeholder="Biaya Pemesanan" min="0" readonly>
                        </div>

                        <div class="form-group">
                            <label for="lead-time">Waktu Tunggu (Hari)</label>
                            <input type="number" class="form-control" name="lead_time" id="lead-time"
                                placeholder="Waktu Tunggu" min="0" readonly>
                        </div>

                        <div class="form-group">
                            <label for="penggunaan-rata-rata">Penggunaan Rata-Rata Harian</label>
                            <input type="number" class="form-control" name="penggunaan_rata_rata"
                                id="penggunaan-rata-rata" placeholder="Penggunaan Rata-Rata Harian" min="0" readonly>
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea class="form-control" name="deskripsi" id="deskripsi"
                                placeholder="Deskripsi Produk" readonly></textarea>
                        </div>

                    </div>
                </div>

            </div>
            <div class="modal-footer justify-content-between">
                <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button> -->
                <!-- <button type="submit" class="btn btn-primary">Simpan Perubahan</button> -->
            </div>
        </div>
    </div>
</div>
<!-- end modal-info-produk -->
@endsection

@section('custom-script')
<script>

    $('#table_produk').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
    });

</script>

<script>

    $(document).ready(function () {

        // handler untuk menambahkan data
        $('#form-add-produk').on('submit', function (e) {
            e.preventDefault();

            let formData = new FormData(this);

            $.ajax({
                url: "{{ route('produk.store') }}",
                method: "POST",
                data: formData,
                processData: false,
                contentType: false,
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
                        title: 'Produk gagal ditambahkan',
                        icon: "error",
                    }).then(() => window.location.reload());
                }
            });
        });

        // handler untuk mengupdate data
        $('#form-update-produk').on('submit', function (e) {
            e.preventDefault();

            let idProduk = $('#id-produk').val();

            let formData = new FormData(this);
            formData.append('_method', 'PUT');

            $.ajax({
                url: `{{ route('produk.update', '') }}/${idProduk}`,
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
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
                        title: 'Produk gagal diperbarui',
                        icon: "error",
                    }).then(() => window.location.reload());
                }
            });
        });

        // handler untuk menghapus data
        $('.btn-delete-produk').click(function () {

            let idProduk = $(this).data('id-produk');

            // Confirm deletion with SweetAlert
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Produk akan dihapus secara permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {

                if (result.isConfirmed) {
                    $.ajax({
                        url: `{{ route('produk.destroy', '') }}/${idProduk}`,
                        method: 'DELETE',
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
                                title: 'Produk gagal dihapus',
                                icon: "error",
                            }).then(() => window.location.reload());
                        }
                    });
                }
            });

        });

        // handle untuk update data
        $('.btn-update-produk').click(function () {

            let idProduk = $(this).data('id-produk');

            let formUpdateProduk = $('#form-update-produk');

            $.ajax({
                url: `{{ route('produk.show', '') }}/${idProduk}`,
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    let produk = data.data;

                    formUpdateProduk.find('#id-produk').val(produk.id);
                    formUpdateProduk.find('#kode-produk').val(produk.kode_produk);
                    formUpdateProduk.find('#nama-produk').val(produk.nama_produk);
                    formUpdateProduk.find('#harga-jual').val(produk.harga_jual);
                    formUpdateProduk.find('#harga-beli').val(produk.harga_beli);
                    formUpdateProduk.find('#biaya-penyimpanan').val(produk.biaya_penyimpanan);
                    formUpdateProduk.find('#biaya-pemesanan').val(produk.biaya_pemesanan);
                    formUpdateProduk.find('#lead-time').val(produk.lead_time);
                    formUpdateProduk.find('#penggunaan-rata-rata').val(produk.penggunaan_rata_rata);
                    formUpdateProduk.find('#deskripsi').val(produk.deskripsi);

                },
                error: function (error) {
                    Swal.fire({
                        title: 'Produk gagal dihapus',
                        icon: "error",
                    }).then(() => window.location.reload());
                }
            });

        });

        // handle untuk info data
        $('.btn-info-produk').click(function () {

            let idProduk = $(this).data('id-produk');

            let modalInfoProduk = $('#modal-info-produk');

            $.ajax({
                url: `{{ route('produk.show', '') }}/${idProduk}`,
                method: 'GET',
                success: function (data) {
                    let produk = data.data;

                    modalInfoProduk.find('#id-produk').val(produk.id);
                    modalInfoProduk.find('#kode-produk').val(produk.kode_produk);
                    modalInfoProduk.find('#gambar-produk').val(produk.gambar);
                    modalInfoProduk.find('#gambar-produk').attr('src', "{{ asset('storage') }}/" + produk.gambar);
                    modalInfoProduk.find('#gambar-produk').attr('alt', produk.nama_produk);
                    modalInfoProduk.find('#nama-produk').val(produk.nama_produk);
                    modalInfoProduk.find('#harga-jual').val(produk.harga_jual);
                    modalInfoProduk.find('#harga-beli').val(produk.harga_beli);
                    modalInfoProduk.find('#biaya-penyimpanan').val(produk.biaya_penyimpanan);
                    modalInfoProduk.find('#biaya-pemesanan').val(produk.biaya_pemesanan);
                    modalInfoProduk.find('#lead-time').val(produk.lead_time);
                    modalInfoProduk.find('#penggunaan-rata-rata').val(produk.penggunaan_rata_rata);
                    modalInfoProduk.find('#deskripsi').val(produk.deskripsi);

                },
                error: function (error) {
                    console.log(error);
                    Swal.fire({
                        title: 'Data produk gagal didapatkan',
                        icon: "error",
                    }).then(() => window.location.reload());
                }
            });

        });

    });

</script>
@endsection
