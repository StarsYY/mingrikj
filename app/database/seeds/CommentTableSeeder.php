<?php


class CommentTableSeeder extends Seeder
{
    public function run(){
        $faker = Faker\Factory::create();
        for ($i = 0; $i < 170; $i++) {
            $aNews = array(
                'comname' => $faker->name,
                'head' => "/images/def.jpg",
                'comtitle' => $faker->sentence(5, true),
                'comcontent' => $faker->paragraph(3, true),
                'created_at' => $faker->dateTimeBetween('-3 years'),
            );
            Comment::create($aNews);
        }
    }
}