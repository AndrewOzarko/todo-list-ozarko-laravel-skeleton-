<?php

namespace App\Modules\User\Tasks;

use App\Modules\User\Repositories\UserRepository;
use App\Ship\Criterias\Eloquent\ThisEqualThatCriteria;
use App\Ship\Parents\Task;
use Prettus\Repository\Exceptions\RepositoryException;

class GetAllUsersTask extends Task
{
    protected $repository;

    /**
     * GetAllUsersTask constructor.
     * @param  UserRepository  $repository
     */
    public function __construct(UserRepository $repository)
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
     * @param  string  $fieldName
     * @param $value
     * @throws RepositoryException
     */
    public function getByField(string $fieldName, $value)
    {
        $this->repository->pushCriteria(new ThisEqualThatCriteria($fieldName, $value));
    }
}