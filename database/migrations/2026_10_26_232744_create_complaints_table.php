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
        Schema::create('complaints', function (Blueprint $table) {
            $table->id();
            $table->string('ticket_number')->unique(); // Kode tiket unik, e.g. PGD-20261027-XXXX
            $table->string('name'); // Nama lengkap pelapor (tanpa harus registrasi/login)
            $table->string('phone'); // No WhatsApp / Telp
            $table->string('email')->nullable(); // Email opsional
            $table->string('category'); // Kategori pengaduan
            $table->string('title'); // Judul pengaduan / aspirasi
            $table->text('content'); // Rincian isi pengaduan
            $table->string('location')->nullable(); // Lokasi kejadian / objek pengaduan
            $table->string('attachment')->nullable(); // Bukti foto / dokumen
            $table->enum('status', ['pending', 'diproses', 'selesai', 'ditolak'])->default('pending');
            $table->text('response')->nullable(); // Jawaban tindak lanjut admin
            $table->timestamp('responded_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('complaints');
    }
};
