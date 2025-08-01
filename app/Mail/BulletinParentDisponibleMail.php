<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BulletinParentDisponibleMail extends Mailable
{
    use Queueable, SerializesModels;

   public function __construct(public Bulletin $bulletin) {}

public function build()
{
    return $this->subject('Bulletin scolaire disponible pour votre enfant')
                ->markdown('emails.bulletins.parent_disponible')
                ->with(['bulletin' => $this->bulletin]);
}

}
