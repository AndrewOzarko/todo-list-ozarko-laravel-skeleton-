<?php

namespace App\Modules\Task\Actions;

use App\Modules\Category\Entities\Category;
use App\Modules\Category\Tasks\CategoryHasTaskTask;
use App\Modules\Category\Tasks\GetAllCategoriesTask;
use App\Modules\Task\Entities\Task;
use App\Modules\Task\Tasks\CreateTaskTask;
use App\Modules\User\Entities\User;
use App\Modules\User\Tasks\GetAuthenticatedUserTask;
use App\Ship\Parents\Action;
use App\Ship\Tasks\GetParamsWithRulesTask;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class CreateTaskAction extends Action
{
    /**
     * @param  Request  $request
     * @return Task
     */
    public function run(Request $request)
    {
        /** @var array $requestData */
        $requestData = $this->call(GetParamsWithRulesTask::class, [$request->all(), $request->rules()]);

        $requestData = array_filter($requestData);

        /** @var Category $category */
        $category = $this->call(GetAllCategoriesTask::class, [], [
            ['findById' => [$requestData['category_id']]]
        ])
        ->first();

        /** @var User $user */
        $user = $this->call(GetAuthenticatedUserTask::class);

        /** @var User $categoryOwner */
        $categoryOwner = $category->user;

        if ($user->id !== $categoryOwner->id) {
            throw ValidationException::withMessages(['category_id' => 'Permission denied.']);
        }

        /** @var Task $task */
        $task = $this->call(CreateTaskTask::class, [$requestData]);

        return $task;
    }
}