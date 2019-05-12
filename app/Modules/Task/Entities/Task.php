<?php

namespace App\Modules\Task\Entities;

use App\Modules\Category\Entities\Category;
use App\Ship\Parents\Entity;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Task extends Entity
{
    protected $fillable = [
        'name',
        'description',
        'category_id'
    ];

    /**
     * @return HasOne
     */
    public function category() : HasOne
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }
}