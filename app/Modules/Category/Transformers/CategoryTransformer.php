<?php

namespace App\Modules\Category\Transformers;

use App\Ship\Parents\Transformer;
use App\Ship\Parents\Entity;
use ReflectionException;

class CategoryTransformer extends Transformer
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
            'created_at' => $entity->created_at,
            'updated_at' => $entity->updated_at
        ];

        return $response;
    }
}
