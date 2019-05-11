<?php


namespace App\Ship\Parents;

use App\Ship\Interfaces\ParentInterface;
use App\Ship\Interfaces\ServiceInterface;
use App\Ship\Traits\CallableTrait;

class Service implements ServiceInterface, ParentInterface
{
    use CallableTrait;
}
