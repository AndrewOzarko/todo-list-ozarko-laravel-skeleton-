<?php

namespace App\Modules\Category\Tasks;

use App\Modules\Category\Entities\Category;
use App\Ship\Parents\Task;
use Exception;

class DeleteCategoryTask extends Task
{
    /**
     * @param  Category  $category
     * @return bool|null
     * @throws Exception
     */
    public function run(Category $category)
    {
        return $category->delete();
    }
}
