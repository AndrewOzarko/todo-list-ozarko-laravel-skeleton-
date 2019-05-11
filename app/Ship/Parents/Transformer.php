<?php


namespace App\Ship\Parents;

use App\Ship\Interfaces\ParentInterface;
use App\Ship\Interfaces\TransformerInterface;
use League\Fractal\TransformerAbstract;
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
}
