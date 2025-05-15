@extends('layouts.main')

@section('title', 'Admin Toko')

@section('sidebar-menu')

@include('admin_toko.menu')

@endsection

@section('content')

<div class="row">

    <div class="col-12 col-md-7">
        <div id="scanner">
        </div>
    </div>

    <div class="col-12 col-md-5">

        <div class="row">

            <div class="col-12">

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Total Harga</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <input type="text" value="Rp. 0" class="form-control" readonly id="total-harga">
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-12">

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Daftar Pembelian</h3>
                    </div>
                    <div class="card-body">

                        <form id="form-daftar-pesanan">

                        </form>

                    <button class="btn btn-primary btn-block" id="btn-simpan-transaksi">Simpan Transaksi</button>
                    </div>

                </div>
            </div>
        </div>

    </div>

</div>

@endsection

@section('custom-script')

<script src="https://cdn.jsdelivr.net/npm/quagga@0.12.1/dist/quagga.min.js"></script>

<script>

    let pesanan = {};

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

    }

    function tambahDaftarPesanan(produk) {

        $('#form-daftar-pesanan').append(`

            <div class="form-group">
                <div class="row">
                    <div class="col-6">
                        <input type="text" class="form-control" value="${produk.nama_produk}" readonly>

                    </div>
                    <div class="col-3">
                        <input type="text" class="form-control" value="${produk.harga_jual}" readonly>
                    </div>
                    <div class="col-3">
                        <input type="number" class="form-control jumlah" min="1" id="jumlah-${produk.kode_produk}" value="1">
                    </div>
                </div>
            </div>
        `);

    }

    function updateTotalHarga() {

        let totalHarga = 0;

        for(let key in pesanan) {
            totalHarga += pesanan[key]['jumlah'] * pesanan[key]['harga_jual'];
        }

        $('#total-harga').val(formatRupiah(totalHarga));


    }

    function onScanSuccess(result) {

        Quagga.stop();
        let barcode = result.codeResult.code;


        if(barcode in pesanan) {
            pesanan[barcode]['jumlah'] += 1;
            let jumlah = $(`#jumlah-${barcode}`);
            jumlah.val(parseInt(jumlah.val()) + 1);
            updateTotalHarga();

        } else {
            $.ajax({
                url: "{{ route('produk.kode-produk', ':barcode')}}".replace(':barcode', barcode),
                method: 'GET',
                success: function(data) {
                    if(data.success) {

                        showToast(`${data.data.kode_produk} - ${data.data.nama_produk}`, icon='success', reload=false);

                        pesanan[barcode] = { jumlah: 1, harga_jual: data.data.harga_jual};
                        tambahDaftarPesanan(data.data);

                        updateTotalHarga();

                    } else {
                        showToast(data.message, icon='warning');
                    }
                },
                error: function(err) {
                    console.log(err);
                }
            });

        }

        setTimeout(() => {

            startScanner();
        }, 500);

    }

    $(document).ready(function() {

        $('#total-harga').val('Rp. 0');
        startScanner();

        $('#btn-simpan-transaksi').click(function() {

            $.ajax({
                url: "{{ route('admintoko.transaksi') }}",
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: { pesanan },
                success: function(data) {
                    if(data.success) {
                        showToast(data.message, icon='success', reload=false);
                    } else {
                        showToast(data.message, icon='error', reload=false);
                    }
                },
                error: function(error) {
                    console.log(error);
                }

            });

        });

        Quagga.onDetected(onScanSuccess);


    });

    $(document).on('click', '[id^="jumlah-"]', function() {
        const barcode = $(this).attr('id').replace('jumlah-', '');
        pesanan[barcode]['jumlah'] = parseInt($(this).val());
        updateTotalHarga();
    });

</script>

@endsection
