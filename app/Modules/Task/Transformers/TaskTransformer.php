<?php

namespace App\Modules\Task\Transformers;

use App\Modules\Category\Transformers\CategoryTransformer;
use App\Modules\Task\Entities\Task;
use App\Ship\Parents\Transformer;
use App\Ship\Parents\Entity;
use League\Fractal\Resource\Item;
use ReflectionException;

class TaskTransformer extends Transformer
{
    /**
     * @var  array
     */
    protected $defaultIncludes = [

    ];

    /**
     * @var  array
     */
    protected $availableIncludes = [
        'category'
    ];

    /**
     * A Fractal transformer.
     *
     * @param Entity $entity
     * @return array
     * @throws ReflectionException
     */
    public function transform(Entity $entity)
    {
        $response = [
            'object' => $this->objectName($entity),
            'id' => $entity->id,
            'name' => $entity->name,
            'description' => $entity->description,
            'created_at' => $entity->created_at,
            'updated_at' => $entity->updated_at
        ];

        return $response;
    }

    /**
     * @param  Task  $task
     * @return Item
     */
    public function includeCategory(Task $task)
    {
        return $this->item($task->category, new CategoryTransformer());
    }
}
