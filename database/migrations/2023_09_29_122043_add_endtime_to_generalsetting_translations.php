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
        Schema::table('generalsetting_translations', function (Blueprint $table) {
            $table->dateTime('endtime')->nullable();
        });

        Schema::table('generalsettings', function (Blueprint $table) {
            $table->dateTime('endtime')->nullable();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('generalsetting_translations', function (Blueprint $table) {
            $table->dropColumn('endtime');
        });
        Schema::table('generalsettings', function (Blueprint $table) {
            $table->dropColumn('endtime');
        });
    }
};
