<?php namespace App\Events;

use App\Events\Event;
use App\Models\Rdv;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class RdvIsSaved extends Event implements ShouldBroadcast {

    use SerializesModels;

    public $rdv;

    /**
     * Create a new event instance.
     *
     * @param Rdv $rdv
     * @return void
     */
    public function __construct(Rdv $rdv)
    {
        $this->rdv = $rdv;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return ['rdv'];
    }

}
