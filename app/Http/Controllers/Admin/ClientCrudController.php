<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ClientRequest;
use App\Models\Client;
use App\Models\ClientField;
use App\Models\Field;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Http\Request;

/**
 * Class ClientCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ClientCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Client::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/client');
        CRUD::setEntityNameStrings('client', 'clients');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {

        CRUD::column('name');
        CRUD::column('email');
        CRUD::column('domain');
        CRUD::column('field');

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']);
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {

        CRUD::field('name');
        CRUD::field('email');
        CRUD::field('domain');
        // CRUD::addField([
        //     'name' => 'field_id', // ключ связи в вашей модели
        //     'label' => "field", // Название поля в форме
        //     'type' => 'repeatable', // Тип поля
        //     'entity' => 'fields', // метод, который возвращает связь в вашей модели
        //     'attribute' => 'rName', // атрибут, который отображается в выпадающем списке
        //     'model' => "App\Models\Field", // название связанной модели
        // ]);

        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number']));
         */
    }
    public function store(Request $request)
    {
        // Используем метод storeCrud контроллера, чтобы сохранить основную модель (Client)
        // $response = $this->store();

        if (!empty($request->name) && !empty($request->email) && !empty($request->domain)) {
            Client::add($request->name, $request->email, $request->domain);
        }



        // return $response;
        return  redirect('/admin/client');
    }
    public function update(Request $request)
    {
        // Используем метод storeCrud контроллера, чтобы сохранить основную модель (Client)
        // $response = $this->store();


        Client::add('name', 'email', 'domain');


        // return $response;
        return  redirect('/admin/client');
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
