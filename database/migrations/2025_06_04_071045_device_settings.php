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
        Schema::create('device_settings', function (Blueprint $table) {
            $table->id();
            $table->string('id_produk', 50);
            $table->float('min_suhu')->default(0);
            $table->float('max_suhu')->default(0);
            $table->enum('lampu', ['ON', 'OFF'])->default('ON');
            $table->enum('fan', ['ON', 'OFF'])->default('OFF');
            $table->timestamps();

            $table->foreign('id_produk')->references('id')->on('produk')->onUpdate('no action')->onDelete('no action');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('device_settings');
    }
};
