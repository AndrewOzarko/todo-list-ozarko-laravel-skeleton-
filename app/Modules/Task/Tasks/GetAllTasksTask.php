<?php

namespace App\Modules\Task\Tasks;

use App\Modules\Task\Repositories\TaskRepository;
use App\Ship\Criterias\Eloquent\ThisEqualThatCriteria;
use App\Ship\Parents\Task;
use Prettus\Repository\Exceptions\RepositoryException;

class GetAllTasksTask extends Task
{
    protected $repository;

    /**
     * GetAllTasksTask constructor.
     * @param  TaskRepository  $repository
     */
    public function __construct(TaskRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return mixed
     */
    public function run()
    {
        return $this->repository->paginate();
    }

    /**
     * @param  int  $id
     * @throws RepositoryException
     */
    public function findById(int $id)
    {
        $this->repository->pushCriteria(new ThisEqualThatCriteria('id', $id));
    }
}