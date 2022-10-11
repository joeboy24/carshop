<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubmodelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('submodels', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('make_id');
            $table->string('sub_name');
            $table->string('sub_code');
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
        Schema::dropIfExists('submodels');
    }
}
