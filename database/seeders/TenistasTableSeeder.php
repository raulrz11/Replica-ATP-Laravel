<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TenistasTableSeeder extends Seeder
{

    public function run(): void
    {
        DB::table('tenistas')->insert([
            [
                'nombre' => 'Raul',
                'puntos' => 2,
                'pais' => 'España',
                'fecha_nacimiento' => '1986-06-03',
                'edad' => 23,
                'altura' => 180,
                'peso' => 70,
                'inicio_profesional' => '2001-04-29',
                'mano_buena' => 'IZQUIERDA',
                'reves' => 'UNA_MANO',
                'entrenador' => 'Carlos Moya',
                'imagen' => 'https://cdn-icons-png.flaticon.com/512/4725/4725937.png',
                'price_money' => 1000,
                'victorias' => 5,
                'derrotas' => 2,
            ],
            [
                'nombre' => 'Mangue',
                'puntos' => 4,
                'pais' => 'Brasil',
                'fecha_nacimiento' => '1986-06-03',
                'edad' => 22,
                'altura' => 185,
                'peso' => 60,
                'inicio_profesional' => '2001-04-29',
                'mano_buena' => 'DERECHA',
                'reves' => 'DOS_MANOS',
                'entrenador' => 'Carles Puyol',
                'imagen' => 'https://cdn-icons-png.flaticon.com/256/4725/4725921.png',
                'price_money' => 2000,
                'victorias' => 7,
                'derrotas' => 4,
            ],
            [
                'nombre' => 'Miguel',
                'puntos' => 1,
                'pais' => 'Brasil',
                'fecha_nacimiento' => '1986-06-03',
                'edad' => 22,
                'altura' => 185,
                'peso' => 60,
                'inicio_profesional' => '2001-04-29',
                'mano_buena' => 'DERECHA',
                'reves' => 'DOS_MANOS',
                'entrenador' => 'Carles Puyol',
                'imagen' => 'https://via.placeholder.com/150',
                'price_money' => 2000,
                'victorias' => 7,
                'derrotas' => 4,
            ],
            [
                'nombre' => 'Eva',
                'puntos' => 10,
                'pais' => 'Brasil',
                'fecha_nacimiento' => '1986-06-03',
                'edad' => 22,
                'altura' => 185,
                'peso' => 60,
                'inicio_profesional' => '2001-04-29',
                'mano_buena' => 'DERECHA',
                'reves' => 'DOS_MANOS',
                'entrenador' => 'Carles Puyol',
                'imagen' => 'https://cdn-icons-png.flaticon.com/512/4725/4725821.png',
                'price_money' => 2000,
                'victorias' => 7,
                'derrotas' => 4,
            ],
        ]);
    }
}
