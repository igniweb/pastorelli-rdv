<?php namespace App;

use App\Events\RdvIsSaved;
use App\Models\Option;
use App\Models\Rdv;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Agenda {

    const DEFAULT_USER_ID = 2;

    /**
     * Agenda owner.
     *
     * @var \App\Models\User
     */
    public $user;

    /**
     * Agenda owner options.
     *
     * @var \App\Models\Option
     */
    public $options;

    /**
     * Class constructor.
     *
     * @param int $userId
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function __construct($userId)
    {
        $this->user = User::find($userId, ['id', 'role', 'first_name', 'last_name', 'email', 'tel']);
        if ( ! $this->user)
        {
            throw new ModelNotFoundException('User #' . $userId . ' cannot be found.');
        }
    }

    /**
     * Returns user options as an associative array.
     *
     * @return array
     */
    public function options()
    {
        if ( ! is_null($this->options))
        {
            return $this->options;
        }

        $options = [];

        $dbOptions = Option::select('key', 'value')->where('user_id', '=', $this->user->id)->get();
        foreach ($dbOptions as $option)
        {
            $options[$option->key] = $option->value;
        }

        return $this->options = $options;
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
        $dbRdvs = $this->dbRdvs($from, $to);
        $guests = $this->guestsInRdvs($dbRdvs);

        $rdvs = [];
        foreach ($dbRdvs as $rdv)
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
    private function dbRdvs($from = false, $to = false)
    {
        $query = Rdv::select('id', 'guest_id', 'start_at', 'end_at', 'duration', 'name', 'email', 'tel', 'body', 'color');
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

        $dbGuests = User::select('id', 'first_name', 'last_name', 'email', 'tel')->whereIn('id', array_pluck($rdvs, 'guest_id'))->get();
        foreach ($dbGuests as $guest)
        {
            $guests[$guest->id] = $guest;
        }

        return $guests;
    }

}
