<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->id();
            $table->string('kode_pinjam')->unique();
            $table->date('tanggal_pinjam');
            $table->date('tanggal_kembali');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('peminjaman_alat', function (Blueprint $table) {
            $table->id();

            $table->foreignId('peminjaman_id')
                ->constrained('peminjaman')
                ->onDelete('cascade');

            $table->foreignId('alat_id')
                ->constrained('alats')
                ->onDelete('cascade');

            $table->integer('jumlah')->default(1);

            $table->timestamps();
        }
        );
    }

    public function down(): void
    {
        Schema::dropIfExists('peminjaman_alat');
        Schema::dropIfExists('peminjaman');
    }
};
