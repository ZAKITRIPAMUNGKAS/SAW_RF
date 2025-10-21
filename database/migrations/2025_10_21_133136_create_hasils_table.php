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
        Schema::create('hasils', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kandidat_id')->constrained('kandidats')->onDelete('cascade');
            $table->decimal('nilai_total_saw', 10, 6); // Nilai akhir SAW (V_i)
            $table->integer('ranking'); // Peringkat berdasarkan nilai SAW
            $table->json('detail_perhitungan')->nullable(); // Detail normalisasi dan perhitungan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hasils');
    }
};
