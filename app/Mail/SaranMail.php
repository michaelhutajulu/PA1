<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SaranMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function build()
    {
        return $this->from(config('mail.from.address'), $this->data['nama']) // akses nama dari array
                    ->subject('Kritik & Saran dari Pengguna')
                    ->view('emails.saran')
                    ->with([
                        'nama' => $this->data['nama'],
                        'email' => $this->data['email'],
                    ]);
    }
    
    
}
