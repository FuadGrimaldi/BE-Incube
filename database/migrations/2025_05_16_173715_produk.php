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
        Schema::create('produk', function (Blueprint $table) {
            $table->string('id', 50)->primary();
            $table->string('nama', 50);
            $table->integer('tinggi');
            $table->integer('lebar');
            $table->integer('kapasitas');
            $table->integer('telur');
            $table->string('pass_access')->unique();
            $table->float('price');
            $table->enum('active', ['Y', 'N']);
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produk');
    }
};
