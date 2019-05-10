<?php

namespace App\Modules\User\Repositories;

use App\Modules\User\Entities\User;
use App\Ship\Parents\Repository;

class UserRepository extends Repository
{
    protected $fieldSearchable = [];

    /**
    * @throws \Prettus\Repository\Exceptions\RepositoryException
    */
    public function boot()
    {

    }

    /**
    * @return string
    */
    function model()
    {
        return User::class;
    }
}