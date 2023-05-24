<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PriceRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Http;

/**
 * Class PriceCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class PriceCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Price::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/price');
        CRUD::setEntityNameStrings('price', 'prices');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {


        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']);
         */

        $this->crud->addColumn([
            'name' => 'id',
            'label' => 'id',
            'type' => 'text',

        ]);
        $this->crud->addColumn([
            'name' => 'isMsk',
            'label' => 'Region',
            'type' => 'closure',
            'function' => function ($entry) {
                return $entry->isMsk ? 'Москва' : 'Регионы';
            }
        ]);

        $this->crud->addColumn([
            'name' => 'product.complect.name',
            'type' => 'text',
            'label' => 'Complect',
        ]);
        $this->crud->addColumn([
            'name' => 'product.supply.name',
            'type' => 'text',
            'label' => 'Supply',
        ]);
        $this->crud->addColumn([
            'name' => 'price', // The db column name
            'label' => "Price", // Table column heading
            'type' => 'closure',
            'function' => function ($entry) {
                return number_format($entry->price, 2, '.', ' '); // format the price with no thousands separator
            }
        ]);


        // FILTER


    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {


        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number']));
         */


        // $this->crud->addField([
        //     'label' => "Secret",
        //     'type' => 'text',
        //     'name' => 'secret_key',
        //     'attributes' => ["step" => "any"] // если вы хотите поддерживать десятичные числа

        // ]);


        $this->crud->addField([
            'label' => "Secret",
            'type' => 'text',
            'name' => 'secret_key',
        ]);

        // $this->crud->setValidation(StoreRequest::class);

        // $this->crud->addField([   // CustomHTML
        //     'name' => 'update_button',
        //     'type' => 'custom_html',
        //     'value' => '<a class="btn btn-sm btn-primary" id="update_button" href="#">Update Prices</a>'
        // ]);

        // Добавьте следующий код в ваш скрипт
        // $this->crud->addButtonFromModelFunction('line', 'update', 'updateButton', 'end');
        $secret_key = Request::input('secret_key');
        return  redirect('api/update-prices/{$secret_key}');
    }
    public function store()
    {
        // $this->crud->setValidation(StoreRequest::class);

        // получение секретного ключа из формы
        $secret_key = Request::input('secret_key');

        // отправка GET запроса к Google Sheets API
        $url = 'https://script.google.com/macros/s/' . $secret_key . '/exec';

        Http::get(url('api/update-prices/' . $secret_key));

        // обработка данных из ответа и сохранение данных здесь...
        redirect(route('update-prices', ['secret_key' => $secret_key]));
        // вызов стандартного метода store
        return  redirect('/admin/prices');
    }
    /**
     * Define what happens when the Update operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
