<?php

namespace App\Modules\User\Actions;

use App\Modules\User\Entities\User;
use App\Modules\User\Tasks\GetAllUsersTask;
use App\Ship\Parents\Action;
use Illuminate\Http\Request;

class GetUserByIdAction extends Action
{
    /**
     * @param  Request  $request
     * @return User
     */
    public function run(Request $request)
    {
        /** @var User $user */
        $user = $this->call(GetAllUsersTask::class, [], [
            ['findById' => [$request->id]]
        ])
        ->first();

        return $user;
    }
}