<?php

use Illuminate\Database\Seeder;

class DeliverySetsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        DB::table('delivery_sets')->truncate();

        Schema::enableForeignKeyConstraints();

        DB::table('delivery_sets')->insert([
            [
                'id'               => 1,
                'mail_template_id' => 1,
                'name'             => 'セット1',
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
            [
                'id'               => 2,
                'mail_template_id' => 1,
                'name'             => 'セット2',
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
            [
                'id'               => 3,
                'mail_template_id' => 1,
                'name'             => 'セット3',
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
        ]);
    }

}
