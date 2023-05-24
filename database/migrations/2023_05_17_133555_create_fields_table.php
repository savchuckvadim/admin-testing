<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fields', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('rName');
            $table->string('type');
            $table->string('action')->nullable();

            $table->string('bitrix_id')->nullable();
            $table->string('value')->nullable();
            
            $table->string('isArray')->nullable();
            $table->string('isInTemplate')->nullable();
            $table->boolean('isЕditableBitrix')->default(false);
            $table->boolean('isЕditableValue')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fields');
    }
};
