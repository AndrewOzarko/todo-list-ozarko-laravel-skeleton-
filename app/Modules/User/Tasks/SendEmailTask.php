<?php

namespace App\Modules\User\Tasks;

use App\Modules\User\Emails\UserWasCreated;
use App\Ship\Parents\Task;
use Illuminate\Mail\Mailer;
use Illuminate\Support\Collection;

class SendEmailTask extends Task
{
    protected $mailer;

    /**
     * SendEmailTask constructor.
     * @param  Mailer  $mailer
     */
    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function run(Collection $data)
    {
        $this->mailer->to($data->get('email'))
            ->send(new UserWasCreated($data));
    }
}