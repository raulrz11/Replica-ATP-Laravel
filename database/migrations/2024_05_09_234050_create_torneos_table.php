<?php

use App\Models\Torneo;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('torneos', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->unsignedBigInteger('secondary_id')->unique()->autoIncrement();
            $table->string('nombre');
            $table->string('ubicacion');
            $table->enum('modalidad', Torneo::$MODALIDADES_VALIDAS);
            $table->enum('categoria', Torneo::$CATEGORIAS_VALIDAS);
            $table->enum('superficie', Torneo::$SUPERFICIES_VALIDAS);
            $table->integer('entradas');
            $table->double('premio');
            $table->date('fecha_inicio');
            $table->date('fecha_finalizacion');
            $table->string('imagen')->default(Torneo::$IMAGE_DEFAULT);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('torneos');
    }
};
