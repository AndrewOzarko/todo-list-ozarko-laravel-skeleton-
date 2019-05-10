<?php


namespace App\Ship\Parents;


use App\Ship\Interfaces\ActionInterface;
use App\Ship\Interfaces\ParentInterface;
use App\Ship\Traits\CallableTrait;

class Action implements ActionInterface, ParentInterface
{
    use CallableTrait;
}