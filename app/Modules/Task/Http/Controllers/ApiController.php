<?php

namespace App\Modules\Task\Http\Controllers;

use App\Modules\Task\Actions\CreateTaskAction;
use App\Modules\Task\Actions\DeleteTaskAction;
use App\Modules\Task\Actions\GetAllTasksAction;
use App\Modules\Task\Actions\GetTaskByIdAction;
use App\Modules\Task\Actions\UpdateTaskAction;
use App\Modules\Task\Entities\Task;
use App\Modules\Task\Http\Requests\CreateTaskRequest;
use App\Modules\Task\Http\Requests\DeleteTaskRequest;
use App\Modules\Task\Http\Requests\GetAllTasksRequest;
use App\Modules\Task\Http\Requests\GetTaskByIdRequest;
use App\Modules\Task\Http\Requests\UpdateTaskRequest;
use App\Modules\Task\Transformers\TaskTransformer;
use App\Ship\Parents\ApiController as ApiParentController;
use Illuminate\Database\Eloquent\Collection;

class ApiController extends ApiParentController
{
    /**
     * @param  GetAllTasksRequest  $request
     * @return mixed
     * @throws \ReflectionException
     */
    public function getAllTasks(GetAllTasksRequest $request)
    {
        /** @var Collection $tasks */
        $tasks = $this->call(GetAllTasksAction::class, [$request]);

        return $this->transform($tasks, TaskTransformer::class);
    }


    /**
     * @param  GetTaskByIdRequest  $request
     * @return mixed
     * @throws \ReflectionException
     */
    public function getTaskById(GetTaskByIdRequest $request)
    {
        /** @var Task $task */
        $task = $this->call(GetTaskByIdAction::class, [$request]);

        return $this->transform($task, TaskTransformer::class);
    }

    /**
     * @param  CreateTaskRequest  $request
     * @return mixed
     * @throws \ReflectionException
     */
    public function createTask(CreateTaskRequest $request)
    {
        /** @var Task $task */
        $task = $this->call(CreateTaskAction::class, [$request]);

        return $this->transform($task, TaskTransformer::class);
    }

    /**
     * @param  UpdateTaskRequest  $request
     * @return mixed
     * @throws \ReflectionException
     */
    public function updateTask(UpdateTaskRequest $request)
    {
        /** @var Task $task */
        $task = $this->call(UpdateTaskAction::class, [$request]);

        return $this->transform($task, TaskTransformer::class);
    }

    /**
     * @param  DeleteTaskRequest  $request
     * @return mixed
     * @throws \ReflectionException
     */
    public function deleteTask(DeleteTaskRequest $request)
    {
        /** @var Task $task */
        $task = $this->call(DeleteTaskAction::class, [$request]);

        return $this->transform($task, TaskTransformer::class);
    }
}