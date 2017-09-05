<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeliverySetVisitorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery_set_visitors', function (Blueprint $table) {
            $table->integer('mail_template_id')->unsigned();
            $table->integer('delivery_set_id')->unsigned();
            $table->integer('visitor_id')->unsigned();
            $table->timestamps();

            /**
             * 外部キー制約
             */
            $table->foreign('mail_template_id')
                ->references('id')
                ->on('mail_templates')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('delivery_set_id')
                ->references('id')
                ->on('delivery_sets')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('visitor_id')
                ->references('id')
                ->on('visitors')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('delivery_set_visitors');
    }
}
