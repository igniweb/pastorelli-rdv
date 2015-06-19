<?php namespace App;

use App\Events\RdvIsSaved;
use App\Models\Rdv;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Agenda {

    /**
     * Agenda owner.
     *
     * @var \App\Models\User
     */
    public $user;

    /**
     * Class constructor.
     *
     * @param int $userId
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function __construct($userId)
    {
        $this->user = User::find($userId);
        if ( ! $this->user)
        {
            throw new ModelNotFoundException('User #' . $userId . ' cannot be found.');
        }
    }

    /**
     * Add rendez-vous to agenda.
     *
     * @param array $data
     * @return \App\Models\Rdv
     */
    public function add($data)
    {
        $data['admin_id'] = $this->user->id;

        $rdv = Rdv::create($data);

        event(new RdvIsSaved($rdv));

        return $rdv;
    }

    /**
     * Returns rdvs from date to date, eager loading guest data.
     *
     * @param string|false $from
     * @param string|false $to
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function rdvs($from = false, $to = false)
    {
        $rawRdvs = $this->rawRdvs($from, $to);
        $guests = $this->guestsInRdvs($rawRdvs);

        $rdvs = [];
        foreach ($rawRdvs as $rdv)
        {
            $guest = ( ! empty($rdv->guest_id) and isset($guests[$rdv->guest_id])) ? $guests[$rdv->guest_id] : null;
            $rdv->setAttribute('guest', $guest);

            $rdvs[] = $rdv;
        }

        return new Collection($rdvs);
    }

    /**
     * Returns rdvs from date to date.
     *
     * @param string|false $from
     * @param string|false $to
     * @return \Illuminate\Database\Eloquent\Collection
     */
    private function rawRdvs($from = false, $to = false)
    {
        $query = Rdv::select('id', 'guest_id', 'start_at', 'end_at', 'duration', 'name', 'email', 'tel', 'body', 'color', 'created_by', 'updated_by');
        $query = $query->where('admin_id', '=', $this->user->id);

        if ($from)
        {
            $from = (strlen($from) === 10) ? $from . ' 00:00:00' : $from;

            $query = $query->where('start_at', '>=', $from);
        }
        if ($to)
        {
            $to = (strlen($to) === 10) ? $to . ' 23:59:59' : $to;

            $query = $query->where('end_at', '<=', $to);
        }

        return $query->orderBy('start_at')->get();
    }

    /**
     * Returns indexed by ID array containing data about guests in RDVs collection.
     *
     * @param \Illuminate\Database\Eloquent\Collection $rdvs
     * @return array
     */
    private function guestsInRdvs($rdvs)
    {
        $guests = [];

        $rawGuests = User::whereIn('id', array_pluck($rdvs, 'guest_id'))->get();
        foreach ($rawGuests as $guest)
        {
            $guests[$guest->id] = $guest;
        }

        return $guests;
    }

}
