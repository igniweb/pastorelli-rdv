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
                'first_name' => 'Sébastien',
                'last_name'  => 'Muller',
                'email'      => 'zepp.muller@gmail.com',
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
