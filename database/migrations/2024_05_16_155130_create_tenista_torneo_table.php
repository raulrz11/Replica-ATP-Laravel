<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tenista_torneo', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenista_id')->constrained('tenistas')->onDelete('cascade');
            $table->unsignedBigInteger('torneo_secondary_id');
            $table->foreign('torneo_secondary_id')->references('secondary_id')->on('torneos')->onDelete('cascade');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tenista_torneo');
    }
};
