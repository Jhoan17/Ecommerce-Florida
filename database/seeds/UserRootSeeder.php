<?php

use Illuminate\Database\Seeder;

class UserRootSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       	DB::table('users')->insert([
       		'user_name' => 'root',
       		'user_email' => 'root@ecommercerflorida.com',
       		'password' => bcrypt("root"),
       		'rol_id' => 10
       	]);

        DB::table('users')->insert([
          'user_name' => 'admin2',
          'user_email' => 'admin2@ecommercerflorida.com',
          'password' => bcrypt("admin2"),
          'rol_id' => 1
        ]);
    }
}
