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
        Schema::create('members', function (Blueprint $table) {
        $table->id(); // Kolom ID otomatis (Primary Key)
        $table->string('name'); // Kolom untuk nama anggota
        $table->string('email')->unique(); // Kolom email (tidak boleh kembar)
        $table->string('status')->default('active'); // Kolom status (default: active)
        $table->timestamps(); // Kolom created_at dan updated_at otomatis
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
