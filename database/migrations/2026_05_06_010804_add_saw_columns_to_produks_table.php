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
        Schema::table('produks', function (Blueprint $table) {
            $table->decimal('rating_avg', 3, 2)->default(0)->comment('Rata-rata rating untuk Kriteria C2');
            $table->integer('terjual')->default(0)->comment('Jumlah terjual untuk Kriteria C4');
            $table->boolean('is_promo')->default(false)->comment('Status diskon untuk Kriteria C5');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('produks', function (Blueprint $table) {
            $table->dropColumn(['rating_avg', 'terjual', 'is_promo']);
        });
    }
};
