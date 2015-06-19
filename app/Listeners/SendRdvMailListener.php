<?php namespace App\Listeners;

use App\Events\RdvIsSaved;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendRdvMailListener implements ShouldQueue {

    use InteractsWithQueue;

    /**
     * Mailer instance.
     *
     * @param \Illuminate\Contracts\Mail\Mailer
     */
    protected $mailer;

    /**
     * Create the event listener.
     *
     * @param \Illuminate\Contracts\Mail\Mailer $mailer
     */
    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * Handle the event.
     *
     * @param \App\Events\RdvIsSaved $event
     */
    public function handle(RdvIsSaved $event)
    {
        $rdv = $event->rdv;

        $this->mailer->send('emails.rdv_saved', ['rdv' => $rdv], function ($message) use ($rdv)
        {
            $message->from('no-reply@pastorelli-rdv.dev', 'No-reply');
            $message->to('smuller@tequilarapido.com');
        });
    }
    
}
