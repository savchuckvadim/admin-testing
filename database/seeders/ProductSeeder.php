<?php

namespace Database\Seeders;

use App\Models\Complect;
use App\Models\Product;
use App\Models\Supply;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Получаем все complects и supplies
        $complects = Complect::all();
        $supplies = Supply::all();

        // Для каждого complect и supply создаем новый product
        foreach ($complects as $complect) {
            foreach ($supplies as $supply) {
                Product::create([
                    'name' =>  $complect->name.' '.$supply->name,
                    'complect_id' => $complect->id,
                    'supply_id' => $supply->id,
                    'complect_number' => $complect->number,
                    'supply_number' => $supply->number,
                    // Добавьте здесь другие поля product, если они есть
                ]);
            }
        }
    }
}
