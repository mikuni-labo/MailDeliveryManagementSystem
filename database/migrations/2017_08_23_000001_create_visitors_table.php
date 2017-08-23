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

            $table->string('name')->nullable();

            // もしくは以下
//             $table->string('last_name')->nullable();
//             $table->string('first_name')->nullable();

            $table->string('organization')->nullable();
            $table->string('department')->nullable();
            $table->string('position')->nullable();
            $table->string('email')->unique();// ユニーク？ ユニークでないならnullable追加
            $table->string('tel', 15)->nullable();
            $table->string('fax', 15)->nullable();
            $table->string('zip_code', 10)->nullable();


            $table->string('address')->nullable();

            // もしくは以下
//             $table->tinyInteger('pref_code')->nullable();
//             $table->string('address_1')->nullable();
//             $table->string('address_2')->nullable();
//             $table->string('building_name')->nullable();

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
