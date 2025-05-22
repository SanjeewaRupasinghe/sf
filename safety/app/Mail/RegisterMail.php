<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RegisterMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data,$data2)
    {
        $this->data = $data;
        $this->data2 = $data2;
       
    }


    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if($this->data['corsId']==8 || $this->data['corsId']==9)
        {
            return $this->subject('Course Register Mail - Safetyfirstmed.ae')
					->view('site.registermail',['data' => $this->data,'data2' => $this->data2])
					->attach('http://safetyfirstmed.ae/storage/pdf/'.$this->data2['card']);
        }
        else
        {
            return $this->subject('Course Register Mail - Safetyfirstmed.ae')
            ->view('site.registermail',['data' => $this->data]);    
        }
    }
}
