<?php namespace App\Http\Controllers;

use App\Events\RdvIsSaved;
use App\Models\Rdv;
use Carbon\Carbon;
use Faker\Factory as Faker;

class HomeController extends Controller {

    public function index()
    {
        $faker = Faker::create();
        $format = 'Y-m-d H:i:s';

        $startAt = $faker->dateTimeBetween('now', '+2 days')->format($format);
        $endAt = Carbon::createFromFormat($format, $startAt)->addMinutes(15)->format($format);

        $rdv = Rdv::create([
            'user_id'    => rand(1, 4),
            'start_at'   => $startAt,
            'end_at'     => $endAt,
            'duration'   => Carbon::createFromFormat($format, $startAt)->diffInMinutes(Carbon::createFromFormat($format, $endAt)),
            'label'      => implode(' ', $faker->words(5)),
            'color'      => substr($faker->hexcolor(), 1),
            'created_by' => rand(1, 4),
            'updated_by' => rand(1, 4),
        ]);
        event(new RdvIsSaved($rdv));

        return view('home.index');
    }

}
