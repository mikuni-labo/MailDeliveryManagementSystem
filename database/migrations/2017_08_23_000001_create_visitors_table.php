<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVisitorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visitors', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name');

            // もしくは以下
//             $table->string('last_name');
//             $table->string('first_name');

            $table->string('organization');
            $table->string('department');
            $table->string('position');
            $table->string('email')->unique();// ユニーク？
            $table->string('tel', 15);
            $table->string('fax', 15);
            $table->string('zip_code', 10);


            $table->string('address');

            // もしくは以下
//             $table->tinyInteger('pref_code');
//             $table->string('address_1');
//             $table->string('address_2');
//             $table->string('building_name');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('visitors');
    }
}
