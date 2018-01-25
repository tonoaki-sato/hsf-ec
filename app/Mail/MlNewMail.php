<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;

class MlNewMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     *
     *
     * @var Request
     */
    private $data;
    
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Request $data)
    {
        //
        $this->_data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->text('emails.ml_new_mail_plain')
                    ->subject($this->_data->subject)
                    ->with([
                        'contents' => $this->_data->contents
                    ]);
    }
}
