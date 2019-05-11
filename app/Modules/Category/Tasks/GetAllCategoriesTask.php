<?php

namespace App\Modules\Category\Tasks;

use App\Modules\Category\Repositories\CategoryRepository;
use App\Ship\Criterias\Eloquent\ThisEqualThatCriteria;
use App\Ship\Parents\Task;
use Prettus\Repository\Exceptions\RepositoryException;

class GetAllCategoriesTask extends Task
{
    protected $repository;

    /**
     * GetAllCategoriesTask constructor.
     * @param  CategoryRepository  $repository
     */
    public function __construct(CategoryRepository $repository)
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

    /**
     * @param  int  $userId
     * @throws RepositoryException
     */
    public function findByUserId(int $userId)
    {
        $this->repository->pushCriteria(new ThisEqualThatCriteria('user_id', $userId));
    }
}
