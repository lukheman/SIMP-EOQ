<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

use App\Constants\StatusTransaksi;
use App\Constants\MetodePembayaran;
use App\Constants\StatusPembayaran;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {

        Schema::create('transaksi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_user')->nullable()->constrained('users')->onDelete('cascade');
            $table->foreignId('id_kurir')->nullable()->constrained('users')->cascadeOnDelete();
            $table->enum('status', StatusTransaksi::values())->default('pending'); // Status pesanan
            $table->enum('status_pembayaran', StatusPembayaran::values())->default('belum_bayar');
            $table->enum('metode_pembayaran', MetodePembayaran::values());
            $table->string('bukti_pembayaran')->nullable();
            $table->timestamp('tanggal')->useCurrent();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
