<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TorneosTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('torneos')->insert([
            [
                'id' => Str::uuid(),
                'nombre' => 'Mutua Open',
                'ubicacion' => 'Colombia, Bogota',
                'modalidad' => 'INDIVIDUALES/DOBLES',
                'categoria' => 'MASTER_250',
                'superficie' => 'ASFALTO',
                'entradas' => 4,
                'premio' => 1500000,
                'fecha_inicio' => '2024-05-27',
                'fecha_finalizacion' => '2024-06-09',
                'imagen' => 'https://mutuamadridopen.com/filters/img/estadio-1.6affd27c.jpg',
            ],
            [
                'id' => Str::uuid(),
                'nombre' => 'Roland Garros',
                'ubicacion' => 'París, Francia',
                'modalidad' => 'INDIVIDUALES',
                'categoria' => 'MASTER_1000',
                'superficie' => 'ARCILLA',
                'entradas' => 6,
                'premio' => 1500000,
                'fecha_inicio' => '2024-05-27',
                'fecha_finalizacion' => '2024-06-09',
                'imagen' => 'https://www.atptour.com/-/media/images/news/2023/06/12/09/16/roland-garros-tournament-profile.jpg',
            ],
            [
                'id' => Str::uuid(),
                'nombre' => 'Wimbeldon',
                'ubicacion' => 'Londres, Inglaterra',
                'modalidad' => 'DOBLES',
                'categoria' => 'MASTER_500',
                'superficie' => 'HIERBA',
                'entradas' => 2,
                'premio' => 1500000,
                'fecha_inicio' => '2024-05-27',
                'fecha_finalizacion' => '2024-06-09',
                'imagen' => 'https://www.atptour.com/-/media/images/atp-tournaments/tournament-images/wimbledon_tournimage.jpg',
            ],
        ]);
    }
}
