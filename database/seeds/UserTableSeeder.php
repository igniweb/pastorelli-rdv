<?php

use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();

        $users = [
            [
                'role'       => 'super-admin',
                'login'      => 'smu',
                'first_name' => 'Sébastien',
                'last_name'  => 'Muller',
                'email'      => 'zepp.muller@gmail.com',
                'tel'        => '06 07 83 64 79',
                'password'   => 'azerty',
            ],
            [
                'role'       => 'admin',
                'login'      => 'roxane',
                'first_name' => 'Roxane',
                'last_name'  => 'Guinheu',
                'email'      => 'roxane83000@hotmail.fr',
                'tel'        => '06 84 43 72 36',
                'password'   => 'azerty',
            ],
            [
                'role'       => 'admin',
                'login'      => 'thierry',
                'first_name' => 'Thierry',
                'last_name'  => 'Ors',
                'email'      => 'thierry.ors@gmail.com',
                'tel'        => '04 93 06 xx 06',
                'password'   => 'azerty',
            ],
            [
                'role'       => 'admin',
                'login'      => 'denise',
                'first_name' => 'Denise',
                'last_name'  => 'Ors',
                'email'      => 'example@mail.com',
                'tel'        => '04 93 06 xx 06',
                'password'   => 'azerty',
            ],
        ];

        foreach ($users as $user)
        {
            $user['password'] = Hash::make($user['password']);

            User::create($user);
        }

        $faker = Faker::create('fr_FR');
        for ($i = 0 ; $i < 10 ; $i++)
        {
            $password = Hash::make('azerty');

            User::create([
                'role'       => 'guest',
                'login'      => $faker->userName(),
                'first_name' => $faker->firstName(),
                'last_name'  => $faker->lastName(),
                'email'      => $faker->email(),
                'tel'        => $faker->phoneNumber(),
                'password'   => $password,
            ]);
        }
    }

}
