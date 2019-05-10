<?php

namespace App\Modules\Authentication\Actions;

use App\Modules\Authentication\Tasks\CallOAuthServerTask;
use App\Ship\Parents\Action;
use Illuminate\Http\Request;

class ApiLoginAction extends Action
{

    /**
     * @param  Request  $request
     * @param $clientId
     * @param $clientPassword
     * @return array
     */
    public function run(Request $request, $clientId, $clientPassword)
    {
        $requestData = [
            'grant_type'    => 'password',
            'client_id'     => $clientId,
            'client_secret' => $clientPassword,
            'username'      => $request->email,
            'password'      => $request->password,
            'scope'         => '',
        ];

        $responseContent = $this->call(CallOAuthServerTask::class, [$requestData]);

        return [
            'response-content' => $responseContent
        ];
    }
}