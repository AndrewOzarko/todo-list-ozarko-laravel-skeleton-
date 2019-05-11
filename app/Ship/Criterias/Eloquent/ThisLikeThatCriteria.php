<?php


namespace App\Ship\Criterias\Eloquent;

use App\Ship\Parents\Criteria;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class ThisLikeThatCriteria
 *
 * @author Andriy Butnar <andriy.butnar@redentu.com>
 */
class ThisLikeThatCriteria extends Criteria
{
    private $key;
    private $value;

    public function __construct($key, $value)
    {
        $this->key = $key;
        $this->value = $value;
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
        return $model->where($this->key, 'like', $this->value);
    }
}
