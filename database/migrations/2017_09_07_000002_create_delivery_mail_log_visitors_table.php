<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeliveryMailLogVisitorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery_mail_log_visitors', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('delivery_mail_log_id')->unsigned();
            $table->integer('visitor_id')->unsigned();
            $table->string('name');
            $table->string('to');
            $table->text('content')->nullable();
            $table->boolean('result')->unsigned();
            $table->text('message')->nullable();
            $table->timestamps();// updated_atは不要だが、モデルの自動記録機能を使用するため

            /**
             * 外部キー制約
             */
            $table->foreign('delivery_mail_log_id')
                ->references('id')
                ->on('delivery_mail_logs')
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
        Schema::dropIfExists('delivery_mail_log_visitors');
    }
}
