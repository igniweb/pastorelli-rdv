<?php

use App\Models\User;
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
                'first_name' => 'Sébastien',
                'last_name'  => 'Muller',
                'email'      => 'zepp.muller@gmail.com',
                'password'   => 'azerty',
            ],
            [
                'role'       => 'admin',
                'first_name' => 'Roxane',
                'last_name'  => 'Guinheu',
                'email'      => 'roxane83000@hotmail.fr',
                'password'   => 'azerty',
            ],
            [
                'role'       => 'admin',
                'first_name' => 'Thierry',
                'last_name'  => 'Ors',
                'email'      => 'thierry.ors@gmail.com',
                'password'   => 'azerty',
            ],
            [
                'role'       => 'admin',
                'first_name' => 'Denise',
                'last_name'  => 'Ors',
                'email'      => 'example@mail.com',
                'password'   => 'azerty',
            ],
        ];

        foreach ($users as $user)
        {
            $user['password'] = Hash::make($user['password']);

            User::create($user);
        }
    }

}
