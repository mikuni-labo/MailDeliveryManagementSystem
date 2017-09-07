<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeliveryMailLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery_mail_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('mail_template_id')->unsigned();
            $table->integer('delivery_set_id')->unsigned();
            $table->boolean('result')->unsigned();
            $table->string('to');
            $table->string('from');
            $table->string('subject');
            $table->text('content');
            $table->text('message');
            $table->timestamps();// updated_atは不要だが、モデルの自動記録機能を使用するため

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

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('delivery_mail_logs');
    }
}
