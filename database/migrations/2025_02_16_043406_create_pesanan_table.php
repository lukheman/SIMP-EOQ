<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pesanan', function (Blueprint $table) {
            $table->id(); // Primary Key (Auto-increment)
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Foreign key ke users
            $table->foreignId('barang_id')->constrained('barang')->onDelete('cascade');
            $table->decimal('total_harga', 10, 2); // Total harga pesanan
            $table->integer('jumlah')->default(1); // pemesanan minimal 1
            $table->enum('status', ['pending', 'diproses', 'dikirim', 'selesai', 'dibatalkan'])->default('pending'); // Status pesanan
            $table->timestamps(); // created_at & updated_at otomatis
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanan');
    }
};
