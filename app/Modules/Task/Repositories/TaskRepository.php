<?php

namespace App\Modules\Task\Repositories;

use App\Modules\Task\Entities\Task;
use App\Ship\Parents\Repository;

class TaskRepository extends Repository
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
        return Task::class;
    }
}