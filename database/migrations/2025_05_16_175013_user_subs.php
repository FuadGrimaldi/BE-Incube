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
        Schema::create('user_subs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_cus')->constrained('users');
            $table->string('id_produk');
            $table->date('start_sub');
            $table->date('end_sub');
            $table->timestamps();

            $table->foreign('id_produk')->references('id')->on('produk')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_subs');
    }
};
