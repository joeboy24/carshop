<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInquiresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inquires', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->string('phone', 20);
            $table->string('email', 50);
            $table->string('message');
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
        Schema::dropIfExists('inquires');
    }
}
