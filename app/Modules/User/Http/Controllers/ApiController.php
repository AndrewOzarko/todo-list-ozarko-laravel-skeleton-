<?php

namespace App\Modules\User\Http\Controllers;

use App\Modules\User\Http\Requests\GetAllUsersRequest;
use App\Ship\Parents\ApiController as ApiParentController;

class ApiController extends ApiParentController
{
    public function getAllUsers(GetAllUsersRequest $request)
    {
    }
}
