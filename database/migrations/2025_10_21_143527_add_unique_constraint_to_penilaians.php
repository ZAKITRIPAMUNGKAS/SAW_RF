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
        Schema::table('penilaians', function (Blueprint $table) {
            // Tambahkan unique constraint untuk mencegah duplikat
            $table->unique(['kandidat_id', 'kriteria_id'], 'penilaians_kandidat_kriteria_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('penilaians', function (Blueprint $table) {
            // Hapus unique constraint
            $table->dropUnique('penilaians_kandidat_kriteria_unique');
        });
    }
};
