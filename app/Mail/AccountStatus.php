<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AccountStatus extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public $user, public $option)
    {
    }
   
    public function build()
    {
        return $this->from(env('MAIL_FROM_ADDRESS'), 'AGAP')
                    ->subject('AGAP - Account Update')
                    ->markdown('emails.account_status', [
                        'user' => $this->user,
                        'option' => $this->option,
                        'url' => route('login'),
        ]); // with params
    }
}
