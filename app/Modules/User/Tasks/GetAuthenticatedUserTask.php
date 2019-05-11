<?php

namespace App\Modules\User\Tasks;

use App\Ship\Parents\Task;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;

class GetAuthenticatedUserTask extends Task
{
    /**
     * @return Authenticatable|null
     */
    public function run()
    {
        return Auth::user();
    }
}
