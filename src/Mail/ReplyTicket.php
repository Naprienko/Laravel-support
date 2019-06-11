<?php

namespace Ingvar\Support\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ReplyTicket extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $user;
    protected $body;
    protected $ticket_id;
    public function __construct($user, $body,$id)
    {
        $this->user = $user;
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
        return $this->view('igs::emails.reply_ticket')
            ->to($this->user)
            ->subject(trans('igs::support.new_ticket_reply'). config('app.name'))
            ->with([
                'body' => $this->body,
                'ticket_id' => $this->ticket_id,
            ]);
    }
}