<?php


namespace App\Ship\Parents;

use App\Ship\Interfaces\ApiControllerInterface;
use App\Ship\Interfaces\EntityInterface;
use App\Ship\Interfaces\ParentInterface;
use App\Ship\Traits\CallableTrait;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use ReflectionClass;
use ReflectionException;
use Spatie\Fractal\Facades\Fractal;

class ApiController implements ApiControllerInterface, ParentInterface
{
    use CallableTrait;

    /**
     * @param $data
     * @param string $transformer
     * @return mixed
     * @throws ReflectionException
     */
    protected function transform($data, string $transformer)
    {
        if($data instanceof Collection || $data instanceof LengthAwarePaginator) {
            return Fractal::collection($data)->transformWith(new $transformer())->toArray();
        }
        else if ((new ReflectionClass($data))->implementsInterface(EntityInterface::class)) {
            return Fractal::item($data)->transformWith(new $transformer())->toArray();
        }
    }
}