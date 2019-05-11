<?php

namespace App\Modules\Category\Tasks;

use App\Modules\Category\Entities\Category;
use App\Modules\User\Entities\User;
use App\Ship\Parents\Task;

class CreateCategoryForUserTask extends Task
{
    /**
     * @param  User  $user
     * @param  array  $data
     * @return Category
     */
    public function run(User $user, array $data)
    {
        /** @var Category $category */
        $category = $user->categories()->create($data);

        return $category;
    }
}
