<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddChatToCompaniesTable extends Migration
{
    public function up()
    {
        if (Schema::hasColumn('companies', 'chat')) {
            return;
        }

        Schema::table('companies', function (Blueprint $table) {
            $table->string('chat')->default('on')->after('website');
        });
    }

    public function down()
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->dropColumn('chat');
        });
    }
}
