<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ClassReminderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $class;
    public $type; // H-1 atau H

    public function __construct($user, $class, $type)
    {
        $this->user  = $user;
        $this->class = $class;
        $this->type  = $type;
    }

    public function build()
    {
        return $this->subject("Reminder Jadwal Latihan - {$this->class->nama_class}")
            ->view('emails.class_reminder');
    }
}
