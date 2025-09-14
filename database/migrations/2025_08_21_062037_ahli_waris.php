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
        Schema::create('ahli_waris', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_meninggal');
            $table->string('tempat_meninggal');
            $table->string('nama_ahli_waris');
            $table->string('nik_ahli_waris');
            $table->enum('jenis_kelamin', ['laki-laki', 'perempuan']);
            $table->integer('umur');
            $table->enum('hubungan_ahli_waris', ['suami', 'istri', 'anak', 'orang_tua', 'saudara', 'lainnya'])->nullable();
            $table->foreignId('detail_surat_id')->constrained('detail_surat')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ahli_waris');
    }
};
