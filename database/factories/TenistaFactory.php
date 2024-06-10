<?php

namespace Database\Factories;

use App\Models\Tenista;
use Illuminate\Database\Eloquent\Factories\Factory;

class TenistaFactory extends Factory
{
    protected $model = Tenista::class;

    public function definition()
    {
        return [
            'nombre' => $this->faker->name,
            'ranking' => $this->faker->numberBetween(1, 100),
            'puntos' => $this->faker->randomFloat(2, 0, 10000),
            'pais' => $this->faker->country,
            'fecha_nacimiento' => $this->faker->date(),
            'edad' => $this->faker->numberBetween(18, 40),
            'altura' => $this->faker->randomFloat(2, 1.5, 2.2),
            'peso' => $this->faker->randomFloat(2, 50, 100),
            'inicio_profesional' => $this->faker->date(),
            'mano_buena' => $this->faker->randomElement(Tenista::$MANO_VALIDA),
            'reves' => $this->faker->randomElement(Tenista::$REVES_VALIDO),
            'entrenador' => $this->faker->name,
            'imagen' => Tenista::$IMAGE_DEFAULT,
            'price_money' => $this->faker->randomFloat(2, 0, 1000000),
            'best_ranking' => $this->faker->numberBetween(1, 100),
            'victorias' => $this->faker->numberBetween(0, 100),
            'derrotas' => $this->faker->numberBetween(0, 100),
            'win_lose' => '0% / 100%',
        ];
    }
}
