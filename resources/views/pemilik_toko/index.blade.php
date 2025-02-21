@extends('layouts.main')

@section('title', 'Pemilik Toko')

@section('sidebar-menu')
@include('pemilik_toko.menu')
@endsection

@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="info-box bg-warning shadow">
            <span class="info-box-icon"><i class="far fa-calendar-alt"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Data Penjualan</span>
                <span class="info-box-number">41,410</span>

                <div class="progress">
                    <div class="progress-bar" style="width: 70%"></div>
                </div>
                <span class="progress-description">
                    <!-- 70% Increase in 30 Days -->
                </span>
            </div>
            <!-- /.info-box-content -->
        </div>
    </div>
    <div class="col-md-6">
        <div class="info-box bg-warning">
            <span class="info-box-icon"><i class="far fa-calendar-alt"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Stok Barang</span>
                <span class="info-box-number">41,410</span>

                <div class="progress">
                    <div class="progress-bar" style="width: 70%"></div>
                </div>
                <span class="progress-description">
                    <!-- 70% Increase in 30 Days -->
                </span>
            </div>
            <!-- /.info-box-content -->
        </div>
    </div>

</div>
@endsection
