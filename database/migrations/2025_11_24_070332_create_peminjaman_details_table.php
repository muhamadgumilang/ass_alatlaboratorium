<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up()
{
    Schema::create('peminjaman_details', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('peminjaman_id');
        $table->unsignedBigInteger('alat_id');
        $table->integer('jumlah');
        $table->timestamps();

        $table->foreign('peminjaman_id')->references('id')->on('peminjaman')->onDelete('cascade');
        $table->foreign('alat_id')->references('id')->on('alat');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjaman_details');
    }
};
