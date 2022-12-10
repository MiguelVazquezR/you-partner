<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ProofOfPaymentMailable extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(public $data)
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Comprobante de pago')
            ->attach($this->data['file']->getRealPath(), [
                'as' => 'Comprobante',
                'mime' => $this->data['file']->getMimeType(),
            ])
            ->markdown('mails.proof-of-payment', ['data' => $this->data]);
    }
}
