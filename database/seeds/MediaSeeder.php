<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class MediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        for ($i = 1; $i <= 50; $i++) {

            DB::table('medias')->insert([
                'name' => $faker->company,
                'proviences' => $faker->city,
                'regencies' => $faker->state,
                'proviences_id' => $faker->randomDigit,
                'regencies_id' => $faker->randomDigit
            ]);
        }
    }
}
