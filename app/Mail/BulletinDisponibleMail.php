<?php

namespace App\Mail;

use App\Models\Bulletin;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BulletinDisponibleMail extends Mailable
{
    use Queueable, SerializesModels;

    public $bulletin;

    public function __construct(Bulletin $bulletin)
    {
        $this->bulletin = $bulletin;
    }

    public function build()
    {
        return $this->subject('Votre bulletin est disponible')
                    ->view('emails.bulletin_disponible');
    }
}
