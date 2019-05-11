<?php

namespace App\Modules\Category\Actions;

use App\Modules\Category\Entities\Category;
use App\Modules\Category\Tasks\UpdateCategoryForUserTask;
use App\Modules\User\Entities\User;
use App\Modules\User\Tasks\GetAuthenticatedUserTask;
use App\Modules\User\Tasks\UserHasCategoryTask;
use App\Ship\Parents\Action;
use App\Ship\Tasks\GetParamsWithRulesTask;
use Illuminate\Http\Request;

class UpdateCategoryAction extends Action
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

        /** @var array $requestData */
        $requestData = $this->call(GetParamsWithRulesTask::class, [$request->all(), $request->rules()]);

        /** @var Category $category */
        $category = $this->call(UpdateCategoryForUserTask::class, [$user, $requestData]);

        return $category;
    }
}
