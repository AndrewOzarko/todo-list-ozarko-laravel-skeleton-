<?php

namespace App\Ship\Criterias\Eloquent;

use App\Ship\Parents\Criteria;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class NotThisIdsCriteria
 *
 * @author Andriy Butnar <andriy.butnar@redentu.com>
 */
class NotThisIdsCriteria extends Criteria
{
    private $ids;

    public function __construct($ids)
    {
        $this->ids = $ids;
    }

    /**
     * Apply criteria in query repository
     *
     * @param                     $model
     * @param RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        return $model->whereNotIn('id', $this->ids);
    }
}
