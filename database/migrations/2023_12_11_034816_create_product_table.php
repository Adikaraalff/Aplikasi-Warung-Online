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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('nama_products');
            $table->string('price');
            $table->string('keterangan');
            // $table->foreignId('id_kategoris')->constrained('kategoris')->cascadeOnUpdate()->cascadeOnDelete();
            $table->bigInteger('id_kategoris')->unsigned();
            $table->string('file')->nullable(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
