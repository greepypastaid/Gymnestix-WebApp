<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Barryvdh\DomPDF\Facade\Pdf;

class MembershipInvoiceMail extends Mailable
{
    use Queueable, SerializesModels;

    public $payment;
    public $invoiceNumber;
    public $status;

    public function __construct($payment, $status = 'Pending')
    {
        $this->payment       = $payment;
        $this->invoiceNumber = $payment->external_id;
        $this->status        = $status;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Invoice Membership - ' . $this->invoiceNumber,
        );
    }

    public function build()
    {
        // Generate PDF via blade
        $pdf = Pdf::loadView('emails.membership_invoice', [
            'payment'       => $this->payment,
            'invoiceNumber' => $this->invoiceNumber,
            'status'        => $this->status,
        ]);

        return $this->view('emails.membership_invoice')  // email body biasa
                    ->attachData(
                        $pdf->output(),
                        $this->invoiceNumber . '.pdf',
                        ['mime' => 'application/pdf']
                    );
    }
}

