<?php


class UserTableSeeder extends Seeder
{
    public function run(){
        /*$user = new User();
        $user->username = "asd";
        $user->email = "asd@google.com";
        $user->password = Hash::make("asd");
        $user->type = "0";
        $user->save();*/

        $faker = Faker\Factory::create();
        for ($i = 0; $i < 6; $i++){
            $aUser = array(
                'username'=>$faker->name,
                'email'=>$faker->email,
                'password'=>Hash::make('123456'),
                'type'=>$faker->numberBetween(0, 1),
                'portrait'=>"/images/def.jpg",
                'created_at'=>$faker->dateTimeBetween('-3 years'),
            );
            User::create($aUser);
        }
    }
}