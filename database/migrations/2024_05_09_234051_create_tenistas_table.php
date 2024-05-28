<?php

use App\Models\Tenista;
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
        Schema::create('tenistas', function (Blueprint $table) {
            $table->id()->primary();
            $table->string('nombre');
            $table->integer('ranking')->nullable();
            $table->double('puntos');
            $table->string('pais');
            $table->date('fecha_nacimiento');
            $table->integer('edad');
            $table->double('altura');
            $table->double('peso');
            $table->date('inicio_profesional');
            $table->enum('mano_buena', Tenista::$MANO_VALIDA);
            $table->enum('reves', Tenista::$REVES_VALIDO);
            $table->string('entrenador');
            $table->string('imagen')->default(Tenista::$IMAGE_DEFAULT);
            $table->double('price_money');
            $table->integer('best_ranking')->nullable();
            $table->integer('victorias');
            $table->integer('derrotas');
            $table->string('win_lose')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tenistas');
    }
};
