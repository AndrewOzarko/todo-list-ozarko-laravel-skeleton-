<?php

namespace App\Modules\User\Transformers;

use App\Ship\Parents\Transformer;
use App\Ship\Parents\Entity;
use ReflectionException;

class UserTransformer extends Transformer
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
            'email' => $entity->email,
            'response-content' => $entity->response_content,
            'created_at' => $entity->created_at,
            'updated_at' => $entity->updated_at
        ];

        return $response;
    }

}
