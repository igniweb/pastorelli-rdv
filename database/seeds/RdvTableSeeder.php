<?php

use App\Agenda;
use App\Models\Rdv;
use Carbon\Carbon;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class RdvTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Rdv::truncate();

        $faker = Faker::create('fr_FR');
        $format = 'Y-m-d H:i:s';

        $agenda = new Agenda(1);

        for ($i = 0 ; $i < 10 ; $i++)
        {
            $startAt = $faker->dateTimeBetween('now', '+2 days')->format($format);
            $endAt = Carbon::createFromFormat($format, $startAt)->addMinutes(15);

            $agenda->add([
                'guest_id'   => rand(5, 14),
                'start_at'   => $startAt,
                'end_at'     => $endAt,
                'duration'   => Carbon::createFromFormat($format, $startAt)->diffInMinutes(Carbon::createFromFormat($format, $endAt)),
                'name'       => $faker->firstName() . ' ' . $faker->lastName(),
                'email'      => $faker->email(),
                'tel'        => $faker->phoneNumber(),
                'body'       => implode(' ', $faker->words(5)),
                'color'      => substr($faker->hexcolor(), 1),
                'created_by' => rand(1, 14),
                'updated_by' => rand(1, 14),
            ]);
        }
    }

}
