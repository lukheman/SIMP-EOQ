@extends('layouts.main')

@section('title', 'Admin Gudang')

@section('sidebar-menu')

@include('admin_gudang.menu')

@endsection

@section('content')
<div class="card">
    <div class="card-header">

        <button class="btn btn-outline-primary" type="button" id="btn-hitung-eoq" data-toggle="modal"
            data-target="#modal-hitung-eoq"> 
            <i class="fas fa-calculator"></i>
            Hitung EOQ</button>

    </div>
    <div class="card-body">
        <div id="table_eoq_wrapper" class="dataTables_wrapper dt-bootstrap4">
            <div class="row">
                <div class="col-sm-12 col-md-6">

                </div>
                <div class="col-sm-12 col-md-6">

                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <table id="table_eoq" class="table table-bordered table-striped dataTable dtr-inline"
                        aria-describedby="table_eoq_info">
                        <thead>
                            <tr>
                                <th class="sorting" tabindex="0" aria-controls="table_eoq" rowspan="1" colspan="1">Nama
                                    Produk</th>
                                <th class="sorting" tabindex="0" aria-controls="table_eoq" rowspan="1" colspan="1">EOQ
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="table_eoq" rowspan="1" colspan="1">
                                    Safety Stock
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="table_eoq" rowspan="1" colspan="1">ROP
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="table_eoq" rowspan="1" colspan="1">Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody>

                            @if(isset($produk))
                                @foreach($produk as $item)
                                    @if ($item->eoq > 0)
                                        <tr>
                                            <td>{{ $item->nama_produk }}</td>
                                            <td>{{ $item->eoq }}</td>
                                            <td>{{ $item->ss }}</td>
                                            <td>{{ $item->rop }}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <button class="btn btn-sm btn-primary btn-update-persediaan" data-toggle="modal"
                                                        data-target="#modal-update-persediaan"
                                                        data-id-persediaan="{{ $item->id }}">Edit</button>
                                                    <button class="btn btn-sm btn-danger btn-delete-persediaan"
                                                        data-id-persediaan="{{ $item->id }}">Hapus</button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            @endif
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
                    <div class="dataTables_paginate paging_simple_numbers" id="table_eoq_paginate">
                        <ul class="pagination">
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- modal-hitung-eoq - modal untuk menampilkan form tambah data produk -->
<div class="modal fade show" id="modal-hitung-eoq" style="display: none;" aria-modal="true" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Update Persediaan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form id="form-hitung-eoq" method="post" action={{ route('admingudang.hitung-eoq') }}>
                @csrf
                <div class="modal-body">

                    <div class="form-group">
                        <label for="periode">Periode</label>
                        <input type="month" name="periode" id="periode" class="form-control">
                    </div>

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary"> 
                    <i class="fas fa-calculator"></i>
                    Hitung</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- end modal-hitung-eoq -->

@endsection

@section('custom-script')
<script>
    $(function () {

        $('#table_eoq').DataTable({
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

        $('#btn-hitung-eoq').click(() => {

            $.ajax({
                url: '{{ route('produk.all') }}',
                method: 'GET',
                success: function (data) {
                    data.data.forEach((item) => {
                        $('#nama-produk').append(new Option(`${item.kode_produk} | ${item.nama_produk}`, item.id))
                    });
                },
                error: function (error) {
                    console.log(error)
                },
            })

        });


    });



</script>
@endsection
