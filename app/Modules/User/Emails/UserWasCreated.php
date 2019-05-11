<?php

namespace App\Modules\User\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Collection;

class UserWasCreated extends Mailable
{
    use Queueable, SerializesModels;

    protected $data;

    /**
     * UserWasCreated constructor.
     * @param  Collection  $data
     */
    public function __construct(Collection $data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Welcome to our website')
            ->view('user::email-for-created-user', [
                'email' => $this->data->get('email'),
                'password' => $this->data->get('password'),
                'url_for_login' =>$this->data->get('url_for_login'),
            ]);
    }
}
