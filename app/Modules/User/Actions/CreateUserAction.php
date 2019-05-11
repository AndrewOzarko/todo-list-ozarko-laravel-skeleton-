<?php

namespace App\Modules\User\Actions;

use App\Modules\User\Entities\User;
use App\Modules\User\Tasks\CreateUserTask;
use App\Modules\User\Tasks\SendEmailTask;
use App\Ship\Parents\Action;
use App\Ship\Tasks\GetParamsWithRulesTask;
use Illuminate\Http\Request;

class CreateUserAction extends Action
{
    /**
     * @param  Request  $request
     * @return User
     */
    public function run(Request $request)
    {
        /** @var array $requestData */
        $requestData = $this->call(GetParamsWithRulesTask::class, [$request->all(), $request->rules()]);

        /** @var User $user */
        $user = $this->call(CreateUserTask::class, [$requestData]);

        $this->call(SendEmailTask::class, [
            collect([
                'email' => $requestData['email'],
                'password' => $requestData['password'],
                'url_for_login' => env('APP_URL'). '/login'
            ])
        ]);

        return $user;
    }
}
