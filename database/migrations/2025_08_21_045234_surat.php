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
        Schema::create('surat', function (Blueprint $table) {
            $table->id();
            $table->string('kode_unik')->unique();
            $table->string('nomor_surat')->nullable();
            $table->date('tanggal_surat');
            $table->string('file_docx_path')->nullable();
            $table->string('file_pdf_path')->nullable();
            $table->integer('persetujuan');
            $table->text('catatan')->nullable();
            $table->foreignId('bidang_surat_id')->constrained('bidang_surat')->cascadeOnDelete();
            $table->foreignId('jenis_surat_id')->constrained('jenis_surat')->cascadeOnDelete();
            $table->foreignId('penandatangan_id')->constrained('penandatangan')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat');
    }
};
