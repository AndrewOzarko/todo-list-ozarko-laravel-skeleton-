<?php


namespace App\Ship\Parents;

use App\Ship\Interfaces\ParentInterface;
use App\Ship\Interfaces\TransformerInterface;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use League\Fractal\TransformerAbstract;
use League\Fractal\TransformerAbstract as FractalTransformer;
use ReflectionClass;
use ReflectionException;

class Transformer extends TransformerAbstract implements TransformerInterface, ParentInterface
{
    /**
     * @param Entity $entity
     * @return string
     * @throws ReflectionException
     */
    protected function objectName(Entity $entity)
    {
        return (new ReflectionClass($entity))->getShortName();
    }

    /**
     * @param mixed                       $data
     * @param callable|FractalTransformer $transformer
     * @param null                        $resourceKey
     *
     * @return Item
     */
    public function item($data, $transformer, $resourceKey = null)
    {
        // set a default resource key if none is set
        if (!$resourceKey && $data) {
            $resourceKey = $data->getResourceKey();
        }

        return parent::item($data, $transformer, $resourceKey);
    }

    /**
     * @param mixed                       $data
     * @param callable|FractalTransformer $transformer
     * @param null                        $resourceKey
     *
     * @return Collection
     */
    public function collection($data, $transformer, $resourceKey = null)
    {
        // set a default resource key if none is set
        if (!$resourceKey && $data->isNotEmpty()) {
            $obj = $data->first();
            $resourceKey = $obj->getResourceKey();
        }

        return parent::collection($data, $transformer, $resourceKey);
    }
}
