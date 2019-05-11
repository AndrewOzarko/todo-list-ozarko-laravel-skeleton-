<?php


namespace App\Ship\Parents;

use App\Ship\Interfaces\ParentInterface;
use App\Ship\Interfaces\SubActionInterface;
use App\Ship\Traits\CallableTrait;

class SubAction implements SubActionInterface, ParentInterface
{
    use CallableTrait;
}
