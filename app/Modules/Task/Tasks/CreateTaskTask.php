<?php

namespace App\Modules\Task\Tasks;

use App\Modules\Task\Repositories\TaskRepository;
use App\Ship\Parents\Task;
use Prettus\Validator\Exceptions\ValidatorException;

class CreateTaskTask extends Task
{
    protected $repository;

    /**
     * CreateTaskTask constructor.
     * @param  TaskRepository  $repository
     */
    public function __construct(TaskRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param  array  $data
     * @return mixed
     * @throws ValidatorException
     */
    public function run(array $data)
    {;
        return $this->repository->create($data);
    }
}