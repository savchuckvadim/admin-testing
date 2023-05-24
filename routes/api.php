<?php

use App\Models\Price;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {

    return $request->user();
});

Route::get('/prices', function (Request $request) {

    return response([
        'prices' => [
            'coefficients' => [1, 2, 3, 7, 10, 20],
            'prof' => [
                'regions' => [
                    'internet' => [],
                    'proxima' => []
                ],
                'msk' => [
                    'internet' => [],
                    'proxima' => []
                ]
            ]
        ]
    ]);
});


Route::get('/update-prices/{secret_key?}', function ($secret_key = null) {

    $default_key = 'AKfycbwrvFwjtpMbN-RYJhXntSPD7xVrjs-6NEz03BK5UzKFDSzspE2RtVnJX8jquL3wSZB1AQ';
    $key = $secret_key ?? $default_key;
    // URL к вашему Google Sheets
    $url = 'https://script.google.com/macros/s/' . $key . '/exec';




    // Отправить GET-запрос к Google Sheets API
    $response = Http::get($url);

    // Получить данные из ответа
    $data = $response->json();
    $profPrices['msk']['internet'] = $response['prices']['prof']['msk']['internet'];
    $profPrices['msk']['proxima'] = $response['prices']['prof']['msk']['proxima'];
    $profPrices['regions']['internet'] = $response['prices']['prof']['regions']['internet'];
    $profPrices['regions']['proxima'] = $response['prices']['prof']['regions']['proxima'];
    // $internet = $profPrices->internet;
    // $proxima = $profPrices->proxima;

    // Обновить цены и идентификаторы продуктов в базе данных
    $allProfPricesMsk = [
        $profPrices['msk']['internet'],
        $profPrices['msk']['proxima'],

    ];
    $allProfPricesRegions = [
        $profPrices['regions']['internet'],
        $profPrices['regions']['proxima']

    ];

    $prices = [
        'msk' => [],
        'regions' => []
    ];


    foreach ($allProfPricesMsk as $priceRegionGroup) {
        foreach ($priceRegionGroup as $priceSupplyGroup) {

            foreach ($priceSupplyGroup as $priceItem) {
                $product = Product::firstOrCreate([
                    'complect_number' => $priceItem['complectNumber'],
                    'supply_number' => $priceItem['supplyNumber'],

                ]);
                $product->save();

                if ($product->id) {
                    $priceRegions = Price::firstOrCreate([
                        'product_id' => $product->id,
                        'price' => $priceItem['price'],
                        'isProf' => true,
                        'isMsk' => false
                    ]);


                    $priceRegions->save();

                    array_push($prices['regions'], $priceRegions);
                }
            }

            foreach ($priceSupplyGroup as $priceItem) {
                $product = Product::firstOrCreate([
                    'complect_number' => $priceItem['complectNumber'],
                    'supply_number' => $priceItem['supplyNumber'],

                ]);
                $product->save();
                if ($product->id) {

                    $priceMsk = Price::firstOrCreate([
                        'product_id' => $product->id,
                        'price' => $priceItem['price'],
                        'isProf' => true,
                        'isMsk' => true
                    ]);


                    $priceMsk->save();

                    array_push($prices['msk'], $priceMsk);
                }
            }
        }
    }



    return response([
        'messaqge' => 'Цены и идентификаторы продуктов обновлены!',
        'prices' => $prices

    ]);
});


Route::get('/fields', function ($secret_key = null) {


    // URL к вашему Google Sheets
    $url = 'https://script.google.com/macros/s/AKfycbzHmIRWl_KMX9SaTNhfuXkxOrlaT44qwU0tw5exH5d_W-97NpSWRSxIdFzpv-VO3LS_/exec';




    // Отправить GET-запрос к Google Sheets API
    $response = Http::get($url);
    // $getedData = $response->body();
    // Получить данные из ответа


    $resultFields = [];

    $searchingFields = json_decode($response->body(), true);
    $searchingFields = $searchingFields['bitrix'];

    foreach ($searchingFields as $type => $fields) {

        foreach ($fields as $field) {

            $resultField = [
                'field' => $field['name'],
                'type' => $type,
                'bitrix_id' => $field['title'],

            ];
            array_push($resultFields, $resultField);
        }
    };

    $data = $resultFields;
    return response([
        'messaqge' => 'Fields !',
        'data' => $data

    ]);
});
