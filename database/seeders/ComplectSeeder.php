<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ComplectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $complects = [
            ['name' => 'Бухгалтер', 'weight' => 3.5, 'number' => 0, 'type' => 'prof'],
            ['name' => 'Бухгалтер госсектора', 'weight' => 4, 'number' => 1, 'type' => 'prof'],

            ['name' => 'Юрист', 'weight' => 9, 'number' => 2, 'type' => 'prof'],
            ['name' => 'Эксперт PRO', 'weight' => 7, 'number' => 3, 'type' => 'prof'],
            ['name' => 'Офис', 'weight' => 11, 'number' => 4, 'type' => 'prof'],

            ['name' => 'Главный Бухгалтер', 'weight' => 7, 'number' => 5, 'type' => 'prof'],
            ['name' => 'Главный Бухгалтер госсектора', 'weight' => 8, 'number' => 6, 'type' => 'prof'],


            ['name' => 'Предприятие', 'weight' => 12.5, 'number' => 7, 'type' => 'prof'],
            ['name' => 'Предприятие PRO', 'weight' => 15.5, 'number' => 8, 'type' => 'prof'],

            // добавьте здесь все 20 комплектов
        ];

        foreach ($complects as $complect) {
            DB ::table('complects')->insert($complect);
        }
    }
}
