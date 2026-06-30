<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('surats', function (Blueprint $table) {
            // Kolom berkas dibuat nullable agar data izin santri yang lama tidak error
            $table->string('berkas_pendukung')->nullable()->after('tanggal_kembali');
        });
    }

    public function down(): void
    {
        Schema::table('surats', function (Blueprint $table) {
            $table->dropColumn('berkas_pendukung');
        });
    }
};
