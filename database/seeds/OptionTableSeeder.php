<?php

use App\Models\Option;
use Illuminate\Database\Seeder;

class OptionTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Option::truncate();

        $options = [
            'current_day_interval' => '20',
            'current_view'         => 'day',
            'day'                  => 'today',
        ];

        for ($i = 1 ; $i <= 4 ; $i++)
        {
            foreach ($options as $key => $value)
            {
                Option::create([
                    'user_id' => $i,
                    'key'     => $key,
                    'value'   => $value,
                ]);
            }
        }
    }

}
