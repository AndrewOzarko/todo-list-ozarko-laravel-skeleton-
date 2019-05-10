<?php

namespace App\Ship\Criterias\Eloquent;

use App\Ship\Abstraction\AbstractCriteria;
use Prettus\Repository\Contracts\RepositoryInterface as PrettusRepositoryInterface;

/**
 * Class GroupByCriteria
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class GroupByCriteria extends AbstractCriteria
{

    /**
     * @var
     */
    private $field;

    /**
     * ThisFieldCriteria constructor.
     *
     * @param $field
     */
    public function __construct($field)
    {
        $this->field = $field;
    }

    /**
     * @param                                                   $model
     * @param \Prettus\Repository\Contracts\RepositoryInterface $repository
     *
     * @return  mixed
     */
    public function apply($model, PrettusRepositoryInterface $repository)
    {
        return $model->groupBy($this->field);
    }

}
