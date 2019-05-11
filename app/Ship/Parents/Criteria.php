<?php


namespace App\Ship\Parents;

use App\Ship\Interfaces\CriteriaInterface;
use App\Ship\Interfaces\ParentInterface;
use Prettus\Repository\Contracts\CriteriaInterface as PrettusCriteria;
use Prettus\Repository\Contracts\RepositoryInterface;

class Criteria implements PrettusCriteria, CriteriaInterface, ParentInterface
{
    /**
     * Apply criteria in query repository
     *
     * @param                     $model
     * @param  RepositoryInterface  $repository
     *
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        // TODO: Implement apply() method.
    }
}
