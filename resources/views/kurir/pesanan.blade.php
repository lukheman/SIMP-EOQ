@extends('layouts.main')

@section('title', 'Kurir')

@section('sidebar-menu')

@include('kurir.menu')

@endsection

@section('content')
<div class="card">
    <div class="card-header">

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
                            <tr>
                                <th class="sorting sorting_asc" tabindex="0" aria-controls="table_pesanan" rowspan="1"
                                    colspan="1" aria-sort="ascending">Tanggal
                                </th>
                                <th class="sorting sorting_asc" tabindex="0" aria-controls="table_pesanan" rowspan="1"
                                    colspan="1" aria-sort="ascending">Penerima
                                </th>
                                <th class="sorting sorting_asc" tabindex="0" aria-controls="table_pesanan" rowspan="1"
                                    colspan="1" aria-sort="ascending">Alamat
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="table_pesanan" rowspan="1" colspan="1">
                                    Status</th>
                                <th class="sorting" tabindex="0" aria-controls="table_pesanan" rowspan="1" colspan="1">
                                    Detail</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($pesanan as $item)
                            <tr>
                                <td> {{ $item->tanggal }}</td>
                                <td> {{ $item->user->name }}</td>
                                <td> {{ $item->user->reseller_detail->alamat }}</td>
                                <td>
                                    @if ($item->status === 'pending')
                                    <span class="badge bg-secondary">{{ $item->status }}</span>
                                    @elseif($item->status === 'diproses')
                                    <span class="badge bg-success">{{ $item->status }}</span>
                                    @elseif($item->status === 'dikirim')
                                    <span class="badge bg-warning">{{ $item->status }}</span>
                                    @elseif($item->status === 'ditolak')
                                    <span class="badge bg-danger">{{ $item->status }}</span>
                                    @endif
                                </td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-secondary btn-detail-transaksi"
                                        data-id-transaksi="{{ $item->id }}" data-toggle="modal"
                                        data-target="#modal-detail-transaksi"> 
                                        <i class="fas fa-eye"></i>
                                        Detail</button>
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


<!-- modal-update-persediaan - modal untuk menampilkan form tambah data produk -->
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
<!-- end modal-update-persediaan -->
@endsection

@section('custom-script')

<script>

    $(document).ready(() => {

        $('.btn-setujui-pesanan').click(function () {
            // TODO: jika telah disetujui maka disabled tombol Setujui

            let idTransaksi = $(this).data('id-transaksi');

            $.ajax({
                url: `{{ route('transaksi.update', '')}}/${idTransaksi}`,
                method: 'PUT',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    'status': 'diproses'
                },
                success: function (data) {
                    Swal.fire({
                        title: data.message,
                        icon: 'success'
                    }).then(() => window.location.reload());
                },
                error: function (error) {
                    console.log(error)
                }

            });
        });

        $('.btn-kirim-pesanan').click(function () {
            let idTransaksi = $(this).data('id-transaksi');

            $.ajax({
                url: `{{ route('transaksi.update', '')}}/${idTransaksi}`,
                method: 'PUT',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    'status': 'dikirim'
                },
                success: function (data) {
                    Swal.fire({
                        title: data.message,
                        icon: 'success'
                    }).then(() => window.location.reload());
                },
                error: function (error) {
                    console.log(error)
                }

            });
        });

        $('.btn-tolak-pesanan').click(function () {
            let idTransaksi = $(this).data('id-transaksi');

            $.ajax({
                url: `{{ route('transaksi.update', '')}}/${idTransaksi}`,
                method: 'PUT',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    'status': 'ditolak'
                },
                success: function (data) {
                    Swal.fire({
                        title: data.message,
                        icon: 'success'
                    }).then(() => window.location.reload());
                },
                error: function (error) {
                    console.log(error)
                }

            });
        });

        $('.btn-detail-transaksi').click(function () {

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



    });
</script>

<script>
    $(function () {

        $('#table_pesanan').DataTable({
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
@endsection
