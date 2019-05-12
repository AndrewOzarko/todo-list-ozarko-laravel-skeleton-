<?php

namespace App\Modules\Task\Actions;

use App\Modules\Category\Entities\Category;
use App\Modules\Task\Entities\Task;
use App\Modules\Task\Tasks\GetAllTasksTask;
use App\Modules\User\Entities\User;
use App\Modules\User\Tasks\GetAuthenticatedUserTask;
use App\Ship\Parents\Action;
use App\Ship\Tasks\GetParamsWithRulesTask;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class DeleteTaskAction extends Action
{
    public function run(Request $request)
    {
        /** @var array $requestData */
        $requestData = $this->call(GetParamsWithRulesTask::class, [$request->all(), $request->rules()]);

        /** @var User $user */
        $user = $this->call(GetAuthenticatedUserTask::class);

        /** @var Task $task */
        $task = $this->call(GetAllTasksTask::class, [], [
            ['findById' => [$requestData['id']]]
        ])
        ->first();

        /** @var Category $category */
        $category = $task->category;

        if (!$user->categories->contains(/**
         * @param $item
         * @return bool
         */ function ($item) use ($category) {
            return $item->id === $category->id;
        })) {
            throw ValidationException::withMessages(['id' => 'Permission denied.']);
        }

        $task->delete();

        return $task;
    }
}