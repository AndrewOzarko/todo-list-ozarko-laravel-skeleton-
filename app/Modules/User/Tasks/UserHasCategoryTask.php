<?php

namespace App\Modules\User\Tasks;

use App\Modules\User\Entities\User;
use App\Ship\Parents\Task;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Validation\ValidationException;

class UserHasCategoryTask extends Task
{
    /**
     * @param  User  $user
     * @param  int  $categoryId
     */
    public function run(User $user, int $categoryId)
    {
        /** @var Collection $categories */
        $categories = $user->categories;

        /** @var bool $hasCategory */
        $hasCategory = $categories->contains(function ($category) use ($categoryId) {
            return $category->id === $categoryId;
        });

        if (!$hasCategory) {
            throw ValidationException::withMessages(['id' => 'Access denied']);
        }
    }
}
