<?php

namespace App\Modules\Category\Actions;

use App\Modules\Category\Entities\Category;
use App\Modules\Category\Tasks\DeleteCategoryTask;
use App\Modules\Category\Tasks\GetAllCategoriesTask;
use App\Modules\User\Entities\User;
use App\Modules\User\Tasks\GetAuthenticatedUserTask;
use App\Modules\User\Tasks\UserHasCategoryTask;
use App\Ship\Parents\Action;
use Illuminate\Http\Request;

class DeleteCategoryAction extends Action
{
    /**
     * @param  Request  $request
     * @return Category
     */
    public function run(Request $request)
    {
        /** @var User $user */
        $user = $this->call(GetAuthenticatedUserTask::class);

        $this->call(UserHasCategoryTask::class, [$user, $request->id]);

        /** @var Category $category */
        $category = $this->call(GetAllCategoriesTask::class, [], [
            [
                'findById' => [$request->id],
                'findByUserId' => [$user->id]
            ]
        ])
        ->first();

        $this->call(DeleteCategoryTask::class, [$category]);

        return $category;
    }
}
