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
                'name'            => '来場者1',
                'organization'    => '株式会社テスト',
                'department'      => 'テスト部署',
                'position'        => '部長',
                'postcode'        => '5430001',
                'address'         => '大阪市天王寺区上本町1-1-1 テストビル1F',
                'email'           => 'k-wada@mikunilabo.com',
                'tel'             => '0667751000',
                'fax'             => '0667752000',
                'exhibitor_type'  => 1,
                'enterprise_type' => 1,
                'created_at'      => Carbon::now(),
                'updated_at'      => Carbon::now(),
            ],
            [
                'id'              => 2,
                'name'            => '来場者2',
                'organization'    => '株式会社テスト',
                'department'      => 'テスト部署',
                'position'        => '課長',
                'postcode'        => '5430001',
                'address'         => '大阪市天王寺区上本町1-1-1 テストビル1F',
                'email'           => 'mikunilabo@gmail.com',
                'tel'             => '0000000000',
                'fax'             => '1111111111',
                'exhibitor_type'  => 2,
                'enterprise_type' => 2,
                'created_at'      => Carbon::now(),
                'updated_at'      => Carbon::now(),
            ],
        ]);
    }

}
