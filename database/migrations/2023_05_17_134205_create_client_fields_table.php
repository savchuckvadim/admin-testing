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
        Schema::create('client_fields', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id');
            $table->foreignId('field_id');
            $table->string('client_name');
            $table->string('domain');
            $table->string('name');
            $table->string('rName');
            $table->string('bitrix_id');
            $table->string('value')->nullable();
            $table->string('action')->nullable();
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
        Schema::dropIfExists('client_fields');
    }
};
