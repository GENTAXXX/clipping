<?php

use App\News;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        $news = News::all()->pluck('id')->toArray();

        for ($i = 1; $i <= 50; $i++) {

            $media_id = $faker->randomElement($news);
            $lang_id = $faker->randomElement($news);
            $project_id = $faker->randomElement($news);

            // insert data ke table pegawai menggunakan Faker
            DB::table('news')->insert([
                'title' => $faker->word,
                'desc' => $faker->text,
                'area' => $faker->country,
                'extract' => $faker->md5,
                'created' => $faker->date,
                'date' => $faker->date,
                'media_id' => $media_id,
                'categories' => $faker->jobTitle,
                'lang_id' => $lang_id,
                'project_id' => $project_id,
                'image' => $faker->sha1
            ]);
        }
    }
}
