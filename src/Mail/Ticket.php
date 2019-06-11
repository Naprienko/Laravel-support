<?php

namespace Ingvar\Support\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Ticket extends Mailable
{
    use Queueable, SerializesModels;


    protected $body;
    protected $ticket_id;
    public function __construct($body,$id)
    {

        $this->body = $body;
        $this->ticket_id = $id;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('igs::emails.ticket')
            ->to(config('mail.admin.address'))
            ->subject(trans('igs::support.new_ticket_reply'). config('app.name'))
            ->with([
                'body' => $this->body,
                'ticket_id' => $this->ticket_id,

            ]);
    }
}