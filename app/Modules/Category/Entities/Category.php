<?php

namespace App\Modules\Category\Entities;

use App\Modules\Task\Entities\Task;
use App\Modules\User\Entities\User;
use App\Ship\Parents\Entity;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Category extends Entity
{
    protected $fillable = [
        'name'
    ];

    /**
     * @return HasMany
     */
    public function tasks() : HasMany
    {
        return $this->hasMany(Task::class, 'category_id', 'id');
    }

    /**
     * @return HasOne
     */
    public function user() : HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
