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
        Schema::create('user_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('no_bpj')->unique();
            $table->string('name');
            $table->string('departemen');
            $table->string('jabatan');
            $table->dateTime('request_date');
            $table->text('deskripsi_permasalahan');
            $table->string('bukti_foto')->nullable();
            $table->enum('jenis', ['urgent', 'non-urgent', 'internal', 'eksternal', 'supervisor'])->default('supervisor');
            $table->enum('status', ['pending', 'ongoing', 'canceled', 'done', 'rejected', 'spv', 'plants', 'admins'])->default('spv');
            $table->enum('tugas', ['pengecekan', 'perbaikan'])->nullable();
            $table->unsignedBigInteger('teknisi_id')->nullable();
            $table->foreign('teknisi_id')->references('id')->on('users');

            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_request');
    }
};
