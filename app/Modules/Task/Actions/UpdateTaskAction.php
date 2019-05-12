<?php

namespace App\Modules\Task\Actions;

use App\Modules\Task\Entities\Task;
use App\Modules\Task\Tasks\UpdateTaskTask;
use App\Modules\User\Entities\User;
use App\Modules\User\Tasks\GetAuthenticatedUserTask;
use App\Ship\Parents\Action;
use App\Ship\Tasks\GetParamsWithRulesTask;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class UpdateTaskAction extends Action
{
    public function run(Request $request)
    {
        /** @var array $requestData */
        $requestData = $this->call(GetParamsWithRulesTask::class, [$request->all(), $request->rules()]);

        /** @var User $user */
        $user = $this->call(GetAuthenticatedUserTask::class);

        /** @var Collection $categories */
        $categories = $user->categories;

        $hasCategory = $categories->contains(function($category) use ($requestData) {
            return $category->id === $requestData['category_id'];
        });

        if ($hasCategory === false) {
            throw  ValidationException::withMessages(['category_id' => 'Permission denied.']);
        }

        /** @var Task $task */
        $task = $this->call(UpdateTaskTask::class, [$requestData]);

        return $task;
    }
}