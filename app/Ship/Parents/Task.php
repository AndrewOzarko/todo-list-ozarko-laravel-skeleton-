<?php


namespace App\Ship\Parents;

use App\Ship\Interfaces\ParentInterface;
use App\Ship\Interfaces\TaskInterface;
use App\Ship\Traits\CallableTrait;

class Task implements TaskInterface, ParentInterface
{
    use CallableTrait;
}
