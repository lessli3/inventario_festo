<?php

namespace App\Mail;

use App\Models\Solicitud;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SolicitudFinalizada extends Mailable
{
    use Queueable, SerializesModels;

    public $solicitud;
    public $pdf;

    public function __construct($solicitud, $pdf)
    {
        $this->solicitud = $solicitud;
        $this->pdf = $pdf;
    }
    
    /**
     * Build the message.
     *
     * @return $this
     */

        public function build()
        {
            return $this->view('emails.solicitudfinalizada')
                        ->subject('Recepción finalizada')
                        ->attachData($this->pdf->output(), 'solicitudfinalizada.pdf', [
                            'mime' => 'application/pdf',
                        ])
                        ->with(['solicitud' => $this->solicitud]);
        }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Solicitud Finalizada',
        );
    }

}
