<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateKinerjasTable extends Migration
{
    public function up(): void
    {
        Schema::table('kinerjas', function (Blueprint $table) {
            $table->date('tanggal_selesai')->after('tugas_jabatan_id');
            $table->integer('nilai')->nullable()->after('tanggal_selesai');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending')->after('nilai');
            $table->string('foto_bukti')->nullable()->after('status');
            $table->text('catatan_atasan')->nullable()->after('foto_bukti');
        });
    }

    public function down(): void
    {
        Schema::table('kinerjas', function (Blueprint $table) {
            $table->dropColumn(['tanggal_selesai', 'nilai', 'status', 'foto_bukti', 'catatan_atasan']);
        });
    }
}
