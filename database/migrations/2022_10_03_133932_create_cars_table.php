<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('stock_id');
            $table->string('make_id');
            $table->string('submodel_id');
            $table->string('inv_loc');
            $table->string('model_code');
            $table->string('price', 25);
            $table->string('year');
            $table->string('mileage');
            $table->string('color');
            $table->string('trans');
            $table->string('drive');
            $table->string('steer');
            $table->string('seat');
            $table->string('eng_type');
            $table->string('door');
            $table->string('eng_size');
            $table->string('body_type');
            $table->string('fuel');
            $table->string('body_len');
            $table->string('vweight');
            $table->string('gvweight');
            $table->string('max_load');
            $table->string('accessory', 500);
            $table->string('flash', 25)->default(0);
            $table->string('promote')->default('no');
            $table->string('status')->default('active');
            $table->string('del')->default('no');
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
        Schema::dropIfExists('cars');
    }
}
