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

class SolicitudEntregada extends Mailable
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
        return $this->view('emails.solicitudentregada')
        ->with(['solicitud' => $this->solicitud])
        ->attachData($this->pdf->output(), 'solicitud_' . $this->solicitud->id . '.pdf', [
            'mime' => 'application/pdf',
        ]);
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Solicitud Entregada',
        );
    }


}
