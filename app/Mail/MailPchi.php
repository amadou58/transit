<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MailPchi extends Mailable
{
    use Queueable, SerializesModels;
    public $pchi;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->pchi= $data['pchi'];
        
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        $subject = $this->pchi->chef_stock_id !== null ? 'Demande de produit chimique Signée - Veuillez créer l\'ordre de travail' : 'Demande de Produit Chimique en Attente de Signature';

        return new Envelope(
            subject: $subject,
        );
    }

    public function build()
    {
        return $this->subject('Sujet de l\'e-mail')
                    ->view('produitchimique.mailpchi'); // Assurez-vous de créer cette vue
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    // public function content()
    // {
    //     return new Content(
    //         view: 'view.name',
    //     );
    // }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
