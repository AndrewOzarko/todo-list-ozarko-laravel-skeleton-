<?php

namespace App\Ship\Criterias\Eloquent;

use App\Ship\Parents\Criteria;
use Prettus\Repository\Contracts\RepositoryInterface as PrettusRepositoryInterface;

/**
 * Class BetweenDatesCriteria
 */
class BetweenDatesCriteria extends Criteria
{
    private $start;
    private $end;
    private $column;

    /**
     * BetweenDatesCriteria constructor.
     * @param $column
     * @param $start
     * @param $end
     */
    public function __construct($column, $start, $end)
    {
        $this->start = $start;
        $this->end = $end;
        $this->column = $column;
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
        return $model->whereBetween($this->column, [$this->start, $this->end]);
    }
}
