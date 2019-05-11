<?php

namespace App\Modules\Category\Repositories;

use App\Modules\Category\Entities\Category;
use App\Ship\Parents\Repository;

class CategoryRepository extends Repository
{
    protected $fieldSearchable = [];

    public function boot()
    {
    }

    /**
    * @return string
    */
    public function model()
    {
        return Category::class;
    }
}
