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
        Schema::create('delegue_quartiers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_habitant');
            $table->foreign('id_habitant')->references('id')->on('habitants');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delegue_quartiers');
    }
};
