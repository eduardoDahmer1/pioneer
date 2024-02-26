<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreign('city_id')->references('id')->on('cities')->onUpdate('RESTRICT')->onDelete('SET NULL');
            $table->foreign('country_id')->references('id')->on('countries')->onUpdate('RESTRICT')->onDelete('SET NULL');
            $table->foreign('state_id')->references('id')->on('states')->onUpdate('RESTRICT')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('users_city_id_foreign');
            $table->dropForeign('users_country_id_foreign');
            $table->dropForeign('users_state_id_foreign');
        });
    }
}
