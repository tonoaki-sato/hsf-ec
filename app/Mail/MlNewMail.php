<?php

namespace App\Mail;

use Swift_Mime_ContentEncoder_PlainContentEncoder;
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
            ->from(env('MAIL_FROM_ADDRESS'), $this->_data['name'])
            ->subject($this->_data['subject'])
            ->withSwiftMessage(function ($message) {
                $message->setCharset('iso-2022-jp')
                        ->setEncoder(new Swift_Mime_ContentEncoder_PlainContentEncoder('7bit'));
            })
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
