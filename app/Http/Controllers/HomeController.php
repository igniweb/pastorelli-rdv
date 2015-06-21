<?php namespace App\Http\Controllers;

use Auth;
use App\Agenda;

class HomeController extends Controller {

    public function index()
    {
        $authUser = Auth::user();

        $agenda = new Agenda($this->agendaUser($authUser));
        $options = $agenda->options();
        $rdvs = $agenda->rdvs();

        return view('home.index', compact('authUser', 'agenda', 'options', 'rdvs'));
    }

    private function agendaUser($user)
    {
        return ! empty($user->id) ? $user->id : Agenda::DEFAULT_USER_ID;
    }

}
