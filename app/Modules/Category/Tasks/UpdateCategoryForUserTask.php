<?php

namespace App\Modules\Category\Tasks;

use App\Modules\Category\Entities\Category;
use App\Modules\User\Entities\User;
use App\Ship\Parents\Task;
use Illuminate\Support\Arr;

class UpdateCategoryForUserTask extends Task
{
    /**
     * @param  User  $user
     * @param  array  $data
     * @return Category
     */
    public function run(User $user, array $data)
    {
        $id = Arr::get($data, 'id');
        unset($data['id']);

        /** @var Category $category */
        $category = $user->categories()
            ->where('id', $id)
            ->first();

        $category->update($data);

        return $category;
    }
}
