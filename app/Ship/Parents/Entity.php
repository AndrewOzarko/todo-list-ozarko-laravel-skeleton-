<?php


namespace App\Ship\Parents;

use App\Ship\Interfaces\EntityInterface;
use App\Ship\Interfaces\ParentInterface;
use App\Ship\Traits\HasResourceKeyTrait;
use Illuminate\Database\Eloquent\Model;

class Entity extends Model implements EntityInterface, ParentInterface
{
    use HasResourceKeyTrait;
}
