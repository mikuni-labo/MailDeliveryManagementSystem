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
            $table->string('organization')->nullable();
            $table->string('department')->nullable();
            $table->string('position')->nullable();
            $table->string('postcode', 8)->nullable();
            $table->text('address')->nullable();
            $table->string('email')->unique();
            $table->string('tel', 15)->nullable();
            $table->string('fax', 15)->nullable();
            $table->boolean('status')->unsigned()->default(true);
            $table->boolean('possible_delivery_flag')->unsigned()->default(true);
            $table->smallInteger('exhibitor_type')->unsigned()->nullable();
            $table->smallInteger('enterprise_type')->unsigned()->nullable();
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
