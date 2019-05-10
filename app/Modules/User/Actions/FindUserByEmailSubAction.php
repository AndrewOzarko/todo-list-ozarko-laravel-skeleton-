<?php

namespace App\Modules\User\Actions;

use App\Modules\User\Entities\User;
use App\Modules\User\Tasks\GetAllUsersTask;
use App\Ship\Parents\SubAction;

class FindUserByEmailSubAction extends SubAction
{
    public function run(string $email)
    {
        /** @var User $user */
        $user = $this->call(GetAllUsersTask::class, [], [
            ['findByField' => [['email'], [$email]]]
        ])
        ->first();

        return $user;
    }
}
