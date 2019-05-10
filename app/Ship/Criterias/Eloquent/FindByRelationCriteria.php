<?php

namespace App\Ship\Criterias\Eloquent;

use App\Ship\Abstraction\AbstractCriteria;
use Prettus\Repository\Contracts\RepositoryInterface as PrettusRepositoryInterface;

/**
 * Class FindByRelationCriteria
 */
class FindByRelationCriteria extends AbstractCriteria
{
    private $relation;
    private $column;
    private $value;

    /**
     * FindByRelationCriteria constructor.
     * @param $relation
     * @param $column
     * @param $value
     \*/
    public function __construct($relation, $column, $value)
    {
        $this->relation = $relation;
        $this->column = $column;
        $this->value = $value;
    }

    /**
     * Apply criteria in query repository
     *
     * @param                     $model
     * @param \Prettus\Repository\Contracts\RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, PrettusRepositoryInterface $repository)
    {
        return $model->whereHas($this->relation, function ($query) {
            $query->where($this->column, $this->value);
        });
    }
}
