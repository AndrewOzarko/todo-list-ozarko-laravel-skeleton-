<?php

namespace App\Modules\Category\Actions;

use App\Modules\Category\Tasks\GetAllCategoriesTask;
use App\Ship\Parents\Action;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class GetAllCategoriesAction extends Action
{
    /**
     * @param  Request  $request
     * @return Collection
     */
    public function run(Request $request)
    {
        /** @var Collection $categories */
        $categories = $this->call(GetAllCategoriesTask::class);

        return $categories;
    }
}
