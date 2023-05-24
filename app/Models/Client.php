<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ClientField;

class Client extends Model
{
    use CrudTrait;
    use HasFactory;
    protected $fillable = ['name', 'email', 'domain'];


    public static function add($name, $email, $domain)
    {

        $fields = Field::where('isЕditableBitrix', true)
               ->orWhere('isЕditableValue', true)
               ->get();
               
        $client = new Client(['name' => $name, 'email' => $email, 'domain' => $domain]);
        $client->save();
        foreach ($fields as $field) {

            // $client[$key] = $field;
            $relation = new ClientField();
            $relation['client_id'] = $client->id;
            $relation['client_name'] = $client->name;
            $relation['domain'] = $client->domain;
            $relation['field_id'] = $field->id;
            $relation['bitrix_id'] = $field['bitrix_id'];
            $relation['value'] = $field['value'];
            $relation['name'] = $field['name'];
            $relation['rName'] = $field['rName'];

            $relation['action'] = $field['action'];
            $relation['isЕditableBitrix'] = $field['isЕditableBitrix'];
            $relation['isЕditableValue'] = $field['isЕditableValue'];
            $relation['isArray'] = $field['isArray'];
            $relation['isInTemplate'] = $field['isInTemplate'];
            $relation->save();

        }

    }

    public function fields(){
        return $this->belongsToMany(Field::class, 'client_fields', 'client_id', 'field_id');
    }
}
