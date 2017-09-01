<?php

use Illuminate\Database\Seeder;

class VisitorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        DB::table('visitors')->truncate();

        Schema::enableForeignKeyConstraints();

        DB::table('visitors')->insert([
            [
                'id'              => 1,
                'name'            => '和田邦康',
                'organization'    => '株式会社テスト',
                'department'      => 'テスト部署',
                'position'        => '部長',
                'postcode'        => '5300047',
                'address'         => '大阪市北区西天満2-6-8 堂島ビルヂング6F',
                'email'           => 'k-wada@mikunilabo.com',
                'tel'             => '0663633800',
                'fax'             => '0663633200',
//                 'status'          => true,
                'exhibitor_type'  => 1,
                'enterprise_type' => 1,
                'created_at'      => Carbon::now(),
                'updated_at'      => Carbon::now(),
//                 'deleted_at'      => Carbon::now(),
            ],
        ]);
    }

}
