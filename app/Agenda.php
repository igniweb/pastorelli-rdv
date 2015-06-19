<?php namespace App;

use App\Models\Rdv;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Agenda {

    /**
     * Agenda owner.
     *
     * @var \App\Models\User
     */
    public $user;

    /**
     * Registered rendez-vous.
     *
     * @var \App\Models\Rdv
     */
    public $rdvs;

    /**
     * Class constructor.
     *
     * @param int $userId
     * @param string|false $from
     * @param string|false $to
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function __construct($userId, $from = false, $to = false)
    {
        $this->user = User::find($userId);
        if ( ! $this->user)
        {
            throw new ModelNotFoundException('User #' . $userId . ' cannot be found.');
        }

        $this->rdvs = $this->rdvsFromTo($from, $to);
    }

    /**
     * Returns rdvs from date to date.
     *
     * @param string|false $from
     * @param string|false $to
     * @return \Illuminate\Database\Eloquent\Collection
     */
    private function rdvsFromTo($from = false, $to = false)
    {
        $query = Rdv::select('id', 'start_at', 'end_at', 'duration', 'label', 'color', 'created_by', 'updated_by');
        $query = $query->where('user_id', '=', $this->user->id);

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

}
