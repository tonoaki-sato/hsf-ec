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
        //
        $this->text('emails.ml_new_mail_plain')
            ->from($this->_data['from'], $this->_data['name'])
            ->subject($this->_data['subject'])
            ->with([
                'contents' => $this->_data['contents']
            ]);
        // ファイル添付
        foreach ($this->_data['attachment'] as $element) {
            $this->attach($element['realPath'], [
                'as' => mb_encode_mimeheader($element['originalName']),
                'mime' => $element['mimeType']
            ]);
        }
        // 返却
        return;
    }
}
