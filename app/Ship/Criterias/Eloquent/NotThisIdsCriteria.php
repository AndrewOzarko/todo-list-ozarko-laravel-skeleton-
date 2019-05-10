<?php

namespace App\Ship\Criterias\Eloquent;

use App\Ship\Abstraction\AbstractCriteria;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class NotThisIdsCriteria
 *
 * @author Andriy Butnar <andriy.butnar@redentu.com>
 */
class NotThisIdsCriteria extends AbstractCriteria
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
