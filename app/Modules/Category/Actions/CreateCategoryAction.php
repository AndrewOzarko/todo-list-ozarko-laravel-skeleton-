<?php

namespace App\Modules\Category\Actions;

use App\Modules\Category\Entities\Category;
use App\Modules\Category\Tasks\CreateCategoryForUserTask;
use App\Modules\User\Entities\User;
use App\Modules\User\Tasks\GetAuthenticatedUserTask;
use App\Ship\Parents\Action;
use App\Ship\Tasks\GetParamsWithRulesTask;
use Illuminate\Http\Request;

class CreateCategoryAction extends Action
{
    /**
     * @param  Request  $request
     * @return Category
     */
    public function run(Request $request)
    {
        /** @var array $requestData */
        $requestData = $this->call(GetParamsWithRulesTask::class, [$request->all(), $request->rules()]);

        /** @var User $user */
        $user = $this->call(GetAuthenticatedUserTask::class);

        /** @var Category $category */
        $category = $this->call(CreateCategoryForUserTask::class, [$user, $requestData]);

        return $category;
    }
}
