<?php


class NewwTableSeeder extends Seeder
{
    public function run(){
        $faker = Faker\Factory::create();
        for ($i = 0; $i < 17; $i++) {
            $aNews = array(
                'title' => $faker->sentence(5, true),
                'publisher' => $faker->name,
                'type' => $faker->numberBetween(0, 1),
                'content' => $faker->paragraphs(4, true),
                'created_at' => $faker->dateTimeBetween('-3 years'),
            );
            Neww::create($aNews);
        }
    }
}