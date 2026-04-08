<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTugasJabatansTable extends Migration
{
    public function up(): void
    {
        Schema::table('tugas_jabatans', function (Blueprint $table) {
            // Menambahkan relasi ke tabel jabatans
            $table->unsignedBigInteger('jabatan_id')->after('id')->nullable();
            
            // Opsional: Menambahkan foreign key constraint
            $table->foreign('jabatan_id')->references('id')->on('jabatans')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('tugas_jabatans', function (Blueprint $table) {
            $table->dropForeign(['jabatan_id']);
            $table->dropColumn('jabatan_id');
        });
    }
}
