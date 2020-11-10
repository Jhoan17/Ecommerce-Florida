<?php

use Illuminate\Database\Seeder;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rols')->insert([
            'rol_name' => 'admin'
        ]);
        
        DB::table('rols')->insert([
            'rol_id' => 10
            'rol_name' => 'root'
        ]);
    }
}
