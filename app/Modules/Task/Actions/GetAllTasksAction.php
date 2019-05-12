<?php

namespace App\Modules\Task\Actions;

use App\Modules\Category\Entities\Category;
use App\Modules\User\Entities\User;
use App\Modules\User\Tasks\GetAuthenticatedUserTask;
use App\Ship\Parents\Action;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class GetAllTasksAction extends Action
{
    /**
     * @param  Request  $request
     * @return \Illuminate\Support\Collection
     */
    public function run(Request $request)
    {
        /** @var User $user */
        $user = $this->call(GetAuthenticatedUserTask::class);

        /** @var Collection $categories */
        $categories = $user->categories;


        /** @var \Illuminate\Support\Collection $tasks */
        $tasks = $categories->map(/**
         * @param Category $category
         */ function($category) {
                return $category->tasks;
            }
        )->flatten();

        return $tasks;
    }
}