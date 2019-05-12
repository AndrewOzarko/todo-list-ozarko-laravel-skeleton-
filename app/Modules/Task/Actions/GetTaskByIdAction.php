<?php

namespace App\Modules\Task\Actions;

use App\Modules\Category\Entities\Category;
use App\Modules\Task\Entities\Task;
use App\Modules\User\Entities\User;
use App\Modules\User\Tasks\GetAuthenticatedUserTask;
use App\Ship\Parents\Action;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class GetTaskByIdAction extends Action
{
    /**
     * @param  Request  $request
     * @return Task
     */
    public function run(Request $request)
    {
        /** @var User $user */
        $user = $this->call(GetAuthenticatedUserTask::class);

        /** @var int $taskId */
        $taskId = $request->id;

        /** @var Collection $categories */
        $categories = $user->categories;

        /** @var \Illuminate\Support\Collection $tasks */
        $tasks = $categories->map(/**
         * @param Category $category
         */ function($category) {
            return $category->tasks;
        }
        )->flatten();

        /** @var Task $task */
        $task = $tasks->map(function($task) use ($taskId) {
            return ($task->id == $taskId) ? $task : null;
        })
        ->filter()
        ->first();

        return $task;
    }
}