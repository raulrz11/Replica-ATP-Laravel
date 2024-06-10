<?php

namespace Database\Factories;

use App\Models\Torneo;
use Illuminate\Database\Eloquent\Factories\Factory;

class TorneoFactory extends Factory
{

    public function definition()
    {
        return [
            'id' => $this->faker->uuid,
            'secondary_id' => $this->faker->unique()->numberBetween(1, 10000),
            'nombre' => $this->faker->sentence(3),
            'ubicacion' => $this->faker->city,
            'modalidad' => $this->faker->randomElement(Torneo::$MODALIDADES_VALIDAS),
            'categoria' => $this->faker->randomElement(Torneo::$CATEGORIAS_VALIDAS),
            'superficie' => $this->faker->randomElement(Torneo::$SUPERFICIES_VALIDAS),
            'entradas' => $this->faker->numberBetween(50, 10000),
            'premio' => $this->faker->randomFloat(2, 1000, 1000000),
            'fecha_inicio' => $this->faker->date(),
            'fecha_finalizacion' => $this->faker->date(),
            'imagen' => Torneo::$IMAGE_DEFAULT,
        ];
    }
}
