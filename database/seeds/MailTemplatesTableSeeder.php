<?php

use Illuminate\Database\Seeder;

class MailTemplatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        DB::table('mail_templates')->truncate();

        Schema::enableForeignKeyConstraints();

        DB::table('mail_templates')->insert([
            [
                'id'           => 1,
                'subject'      => 'テンプレート1の題名',
                'content'      => 'テンプレート1の本文',
                'from'         => 1,
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
            [
                'id'           => 2,
                'subject'      => 'テンプレート2の題名',
                'content'      => 'テンプレート2の本文',
                'from'         => 1,
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
        ]);
    }

}
