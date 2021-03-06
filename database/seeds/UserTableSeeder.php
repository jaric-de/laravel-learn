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
        $faker = Faker\Factory::create();

        DB::table('users')->insert([
            'name' => 'yaroslav',
            'email' => 'yaroslav@gmail.com',
            'password' => bcrypt('yarobum'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
