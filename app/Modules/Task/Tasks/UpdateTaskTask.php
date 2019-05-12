<?php

namespace App\Modules\Task\Tasks;

use App\Modules\Task\Repositories\TaskRepository;
use App\Ship\Parents\Task;
use Illuminate\Support\Arr as ArrAlias;
use Prettus\Validator\Exceptions\ValidatorException;

class UpdateTaskTask extends Task
{
    protected $repository;

    /**
     * UpdateTaskTask constructor.
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
    {
        $id = ArrAlias::get($data, 'id');
        ArrAlias::forget($data, 'id');

        return $this->repository->update($data, $id);
    }
}