<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'yarobum',
            'email' => 'yarobum@gmail.com',
            'password' => bcrypt('yarobum'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
