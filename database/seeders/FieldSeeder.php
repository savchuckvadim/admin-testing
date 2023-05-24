<?php

namespace Database\Seeders;

use App\Models\Field;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class FieldSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $response = Http::get('https://script.google.com/macros/s/AKfycbx01ig6ToxHsWtVdFYyAVRHaDje_ymel51bwck-uacEL3zF5tyRM7eZxJmaXEcPR2QuBA/exec');

        if ($response->successful()) {

            // $getedData = $response->body();
            // Получить данные из ответа


            $resultFields = [];

            $searchingFields = json_decode($response->body(), true);
            $searchingFields = $searchingFields['bitrix'];

            foreach ($searchingFields as $type => $fields) {

                foreach ($fields as $field) {

                    $resultField = [
                        'name' => $field['name'],
                        'rName' => $field['rName'],
                        'type' => $type,
                        'bitrix_id' => $field['title'],
                        'value' => $field['value'],
                        'action' => $field['action'],
                        // isArray, isInTemplate
                        'isArray' => $field['isArray'],
                        'isInTemplate' => $field['isInTemplate'],
                        'isЕditableBitrix' => $field['isЕditableBitrix'],
                        'isЕditableValue' => $field['isЕditableValue'],
                        'action' => $field['action']
                    ];
                    // array_push($resultFields, $resultField);
                    DB::table('fields')->insert($resultField);
                }
            };
        }
    }
}
