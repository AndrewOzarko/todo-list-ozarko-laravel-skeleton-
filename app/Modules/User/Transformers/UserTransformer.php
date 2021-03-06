<?php

namespace App\Modules\User\Transformers;

use App\Modules\Category\Transformers\CategoryTransformer;
use App\Modules\User\Entities\User;
use App\Ship\Parents\Transformer;
use App\Ship\Parents\Entity;
use League\Fractal\Resource\Collection;
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
        'categories'
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

    /**
     * @param  User  $user
     * @return Collection
     */
    public function includeCategories(User $user)
    {
        return $this->collection($user->categories, new CategoryTransformer());
    }
}
