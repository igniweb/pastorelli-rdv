<?php namespace App\Http\Controllers;

use App\Agenda;

class HomeController extends Controller {

    public function index()
    {
        $agenda = new Agenda(1);

        $rdvs = $agenda->rdvs();

        return view('home.index', compact('agenda', 'rdvs'));
    }

}
