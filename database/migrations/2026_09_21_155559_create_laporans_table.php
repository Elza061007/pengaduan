<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('laporans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('kode', 20)->unique();
            $table->string('judul');
            $table->enum('kategori', ['fasilitas', 'kekerasan', 'guru', 'kebersihan', 'lainnya'])
                  ->default('lainnya');
            $table->text('isi');
            $table->string('lampiran')->nullable();
            $table->enum('status', ['menunggu', 'diproses', 'selesai', 'ditolak'])
                  ->default('menunggu');
            $table->text('tanggapan')->nullable();
            $table->timestamp('diproses_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('laporans');
    }
};