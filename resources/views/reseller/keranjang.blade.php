@extends('layouts.main')

@section('title', 'Toko Kecil')

@section('sidebar-menu')
@include('reseller.menu')
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <button type="button" class="btn btn-outline-primary" id="btn-show-modal-metode-pembayaran"  {{ $pesanan->count() == 0 ? 'disabled' : '' }}>
        <i class="fas fa-cash-register"></i>
        Checkout</button>

        <button type="button" class="btn btn-outline-danger" id="btn-delete-pilihan-pesanan" style="display: none;">
        <i class="fas fa-trash"></i>Hapus</button>
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
                    <!-- TODO: buat menjadi lebih estetik -->
                    <table id="table_pesanan" class="table table-bordered table-striped dataTable dtr-inline"
                        aria-describedby="table_pesanan_info">
                        <thead>
                            <tr>
                                <!-- TODO: ganti jadi select all -->
                                <th><input type="checkbox" id="select-all" style="width: 25px; height: 25px;"></th>
                                <th>Nama Produk</th>
                                <th>Jumlah</th>
                                <th>Harga Satuan (Rp.)</th>
                                <th>Total Harga (Rp.)</th>
                                <th class="column-aksi">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($pesanan as $item)
                            <tr>
                                <td > <input type="checkbox" class="select-row" data-id-pesanan="{{ $item->id }}"  style="width: 25px; height: 25px;"> </td>
                                <td> {{ $item->produk->nama_produk }}</td>
                                <td> {{ $item->jumlah }}</td>
                                <td> {{ number_format($item->produk->harga_jual, 0, ',', '.')}}</td>
                                <td> {{ number_format($item->total_harga, 0, ',', '.')}}</td>
                                <td class="column-aksi">
                                    <button class="btn btn-outline-danger btn-sm btn-delete-pesanan" data-id-pesanan="{{ $item->id }}">
                                        <i class="fas fa-trash"></i>
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

<div class="modal fade show" id="modal-metode-pembayaran" style="display: none;" aria-modal="true" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Pilih Metode Pembayaran</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form id="form-checkout">
            <div class="modal-body">

                <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="metode_pembayaran" value="cod">
                        <label class="form-check-label">Cash On Delivery (COD)</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="metode_pembayaran" value="transfer">
                        <label class="form-check-label">Transfer</label>
                    </div>
                </div>
            </div>

            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary" id="btn-checkout"></i>Checkout</button>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('custom-script')

<script>

    function getSelectedItem() {

        let idPesananDipilih = [];

        $('.select-row:checked').each(function() {
            let idPesanan = $(this).data('id-pesanan');
            idPesananDipilih.push(idPesanan);
        });

        return idPesananDipilih;

    }

    $(document).ready(() => {

        $('#select-all').click(function() {
            $('.select-row').prop('checked', this.checked);
        });

        $('.select-row, #select-all').click(function() {

            if (!this.checked) {
                $('#select-all').prop('checked', false);
            }

            $('.select-row').each(function() {
                if(this.checked) {
                    $('.column-aksi').hide();
                    $('#btn-delete-pilihan-pesanan').show();
                    return false;
                } else {
                    $('.column-aksi').show();
                    $('#btn-delete-pilihan-pesanan').hide();
                }
            });

        });

        $('#btn-delete-pilihan-pesanan').click(function() {

            const ids = [];
            $('.select-row:checked').each(function() {
                ids.push($(this).data('id-pesanan'));
            });

            $.ajax({
                url: `{{ route('pesanan.destroy-many') }}`,
                method: 'POST',
                data: {
                    ids
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    showToast('success', data.message);
                },
                error: function (error) {
                    showToast('error', 'Pesanan gagal dihapus');
                }
            });


        });


        $('#btn-checkout').click(function() {
            $('#modal-metode-pembayaran').modal('hide');
        });

        $('#btn-show-modal-metode-pembayaran').click(function() {
            const idPesananDipilih = getSelectedItem();
            if(idPesananDipilih.length == 0) {

                showToast('warning', 'Silakan pilih barang yang ingin Anda checkout.')

            } else {
                $('#modal-metode-pembayaran').modal('show');
            }
        });

        $('#form-checkout').on('submit', function(e) {
            e.preventDefault();

            const data = $(this).serializeArray();
            data.push({ name: 'pesanan_dipilih', value: getSelectedItem()});

            $.ajax({
                url: '{{ route('transaksi.store') }}',
                method: 'POST',
                data: $.param(data),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    setTimeout(() => {
                        window.location.reload();
                    }, 3000);
                    showToast('success', data.message);
                },
                error: function (error) {
                    showToast('error', 'Gagal melakukan transaksi');
                }

            });
        });

        $('.btn-delete-pesanan').click(function() {
            const idPesanan = $(this).data('id-pesanan');

            $.ajax({
                url: `{{ route('pesanan.destroy', ':id') }}`.replace(':id', idPesanan),
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    setTimeout(() => {
                        window.location.reload();
                    }, 3000)
                    showToast('success', data.message);
                },
                error: function (error) {
                    setTimeout(() => {
                        window.location.reload();
                    }, 3000)
                    showToast('error', 'Pesanan gagal dihapus');
                }
            });

        });

    });

</script>

<script>
    $(document).ready(function() {


        $('#table_pesanan').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });

    });


</script>

@endsection
