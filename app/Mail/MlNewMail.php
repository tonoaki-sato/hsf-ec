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
    public function __construct(Array $data)
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
        // ファイル添付
        foreach ($this->_data['attachment'] as $element) {
            $this->attach($element['realPath'], [
                'as' => mb_encode_mimeheader($element['originalName']),
                'mime' => $element['mimeType']
            ]);
        }
        
        return $this->text('emails.ml_new_mail_plain')
                    ->from(env('MAIL_FROM_ADDRESS'), $this->_data['name'])
                    ->subject($this->_data['subject'])
                    ->with([
                        'contents' => mb_convert_encoding($this->_data['contents'],"ASCII", "UTF-8");
                    ]);
    }
}
