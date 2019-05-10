<?php

namespace App\Ship\Criterias\Eloquent;

use App\Ship\Abstraction\AbstractCriteria;
use Prettus\Repository\Contracts\RepositoryInterface as PrettusRepositoryInterface;

/**
 * Class ThisIdsCriteria
 *
 * @author Andriy Butnar <andriy.butnar@redentu.com>
 */
class WhereInCriteria extends AbstractCriteria
{

    /**
     * @var string
     */
    private $field;

    /**
     * @var array
     */
    private $data;

    /**
     * WhereInCriteria constructor.
     * @param string $field
     * @param array $data
     */
    public function __construct(string $field, array $data)
    {
        $this->field = $field;
        $this->data = $data;
    }

    /**
     * @param                                                   $model
     * @param PrettusRepositoryInterface $repository
     *
     * @return  mixed
     */
    public function apply($model, PrettusRepositoryInterface $repository)
    {
        return $model->whereIn($this->field, $this->data);
    }
}
