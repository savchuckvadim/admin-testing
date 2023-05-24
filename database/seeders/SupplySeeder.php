<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SupplySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $supplies = [
            ['name' => 'Интернет 1 ОД', 'od' => '1 Одновременный доступ', 'number' => 0, 'type' => 'internet'],
            ['name' => 'Интернет 2 ОД', 'od' => '2 Одновременных доступа', 'number' => 1, 'type' => 'internet'],
            ['name' => 'Интернет 3 ОД', 'od' => '3 Одновременных доступа', 'number' => 2, 'type' => 'internet'],
            ['name' => 'Интернет 5 ОД', 'od' => '5 Одновременных доступа', 'number' => 3, 'type' => 'internet'],
            ['name' => 'Интернет 10 ОД', 'od' => '10 Одновременных доступа', 'number' => 4, 'type' => 'internet'],
            ['name' => 'Интернет 20 ОД', 'od' => '20 Одновременных доступа', 'number' => 5, 'type' => 'internet'],
            ['name' => 'Интернет 30 ОД', 'od' => '30 Одновременных доступа', 'number' => 6, 'type' => 'internet'],
            ['name' => 'Интернет 50 ОД', 'od' => '50 Одновременных доступа', 'number' => 7, 'type' => 'internet'],
            ['name' => 'Проксима Флэш', 'od' => 'Flash', 'number' => 0, 'type' => 'proxima'],
            ['name' => 'Проксима 1 ОД', 'od' => '1 Одновременный доступ', 'number' => 1, 'type' => 'proxima'],
            ['name' => 'Проксима 2 ОД', 'od' => '2 Одновременных доступа', 'number' => 2, 'type' => 'proxima'],
            ['name' => 'Проксима 3 ОД', 'od' => '3 Одновременных доступа', 'number' => 3, 'type' => 'proxima'],
            ['name' => 'Проксима 5 ОД', 'od' => '5 Одновременных доступа', 'number' => 4, 'type' => 'proxima'],
            ['name' => 'Проксима 10 ОД', 'od' => '10 Одновременных доступа', 'number' => 5, 'type' => 'proxima'],
            ['name' => 'Проксима 20 ОД', 'od' => '20 Одновременных доступа', 'number' => 6, 'type' => 'proxima'],
            ['name' => 'Проксима 30 ОД', 'od' => '30 Одновременных доступа', 'number' => 7, 'type' => 'proxima'],
            ['name' => 'Проксима 50 ОД', 'od' => '50 Одновременных доступа', 'number' => 8, 'type' => 'proxima'],



            // добавьте здесь все 20 комплектов
        ];

        foreach ($supplies as $supply) {
            DB::table('supplies')->insert($supply);
        }
    }
}
