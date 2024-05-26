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
        Schema::create('laporans', function (Blueprint $table) {
            $table->string('kode_laporan')->primary();
            $table->string('judul_laporan');
            $table->text('isi_laporan');
            $table->text('lampiran_laporan')->nullable();
            $table->enum('jenis_laporan', ['pengaduan', 'informasi']);
            $table->boolean('status_laporan')->default(false);
            $table->text('tanggapan_laporan')->nullable();
            $table->foreignId('user_id');
            $table->timestamps();

            // relasi ke user
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporans');
    }
};
