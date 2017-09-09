<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        DB::table('users')->truncate();

        Schema::enableForeignKeyConstraints();

        DB::table('users')->insert([
            [
                'id'           => 1,
                'name'         => '管理者',
                'email'        => 'test@admin.jp',
                'password'     => bcrypt('p1p1p1p1'),
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
            [
                'id'           => 2,
                'name'         => '和田邦康',
                'email'        => 'k-wada@mikunilabo.com',
                'password'     => bcrypt('p1p1p1p1'),
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
        ]);
    }

}
