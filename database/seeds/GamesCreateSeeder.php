<?php

use Illuminate\Database\Seeder;

class GamesCreateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        $faker = Faker\Factory::create();
        $userIds = \App\User::pluck('id')->toArray();

        $limit = 5;
        for ($i = 0; $i < $limit; $i++) {

            DB::table('games')->insert([
                'title' => $faker->realText(20, 2),
                'user_id' => $faker->randomElement($userIds),
                'platform' => $faker->randomElement(['pc', 'ps4', 'xbox']),
                'genre' => $faker->randomElement(['action', 'strategy', 'quest', 'sport_simulator']),
                'price' => $faker->randomFloat(2, 0, 100),
                'description' => $faker->text(150),
                'duration' => $faker->randomNumber(),
                'release_year' => $faker->numberBetween(1950, now()->year),
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
