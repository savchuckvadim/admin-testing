<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use CrudTrait;
    use HasFactory;



    public function complect()
    {

        return $this->belongsTo(Complect::class);
    }


    public function supply()
    {

        return $this->belongsTo(Supply::class);
    }

    public function prices()
    {

        return $this->hasMany(Supply::class);
    }


}
