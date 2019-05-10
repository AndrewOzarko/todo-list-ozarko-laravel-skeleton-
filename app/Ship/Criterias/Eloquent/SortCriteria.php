<?php

namespace App\Ship\Criterias\Eloquent;

use App\Modules\Contact\Repositories\ContactRepository;
use App\Ship\Abstraction\AbstractCriteria;
use Illuminate\Http\Request;
use Prettus\Repository\Contracts\RepositoryInterface as PrettusRepositoryInterface;

/**
 * Class SortCriteria.
 *
 */
class SortCriteria extends AbstractCriteria
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @param                                                   $model
     * @param PrettusRepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, PrettusRepositoryInterface $repository)
    {
        if (!$sort = $this->request->get('sortBy')) return $model->orderBy('id', 'desc');

        list($field, $sortType) = explode(':', $this->request->get('sortBy'));

        if (!empty($field) && !empty($sortType)) {

            $model = $model->orderBy($field, $sortType);
        }

        return $model;
    }

}
