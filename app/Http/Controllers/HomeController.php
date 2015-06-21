<?php namespace App\Http\Controllers;

use Auth;
use App\Agenda;
use App\Models\User;
use Carbon\Carbon;

class HomeController extends Controller {

    public function index()
    {
        $doctors = User::doctors();

        $authUser = Auth::user();
        $agenda = new Agenda($this->agendaUser($authUser));
        $options = $agenda->options();

        $day = Carbon::now()->addDay()->format('Y-m-d');
        $agenda->setup($day, $day);

        return view('home.index', compact('doctors', 'agenda', 'options', 'day'));
    }

    private function agendaUser($user)
    {
        return ! empty($user->id) ? $user->id : Agenda::DEFAULT_USER_ID;
    }

}
