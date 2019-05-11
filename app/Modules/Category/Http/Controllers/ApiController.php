<?php

namespace App\Modules\Category\Http\Controllers;

use App\Modules\Category\Actions\CreateCategoryAction;
use App\Modules\Category\Actions\DeleteCategoryAction;
use App\Modules\Category\Actions\GetAllCategoriesAction;
use App\Modules\Category\Actions\GetCategoryByIdAction;
use App\Modules\Category\Actions\UpdateCategoryAction;
use App\Modules\Category\Entities\Category;
use App\Modules\Category\Http\Requests\CreateCategoryRequest;
use App\Modules\Category\Http\Requests\DeleteCategoryRequest;
use App\Modules\Category\Http\Requests\GetAllCategoriesRequest;
use App\Modules\Category\Http\Requests\GetCategoryByIdRequest;
use App\Modules\Category\Http\Requests\UpdateCategoryRequest;
use App\Modules\Category\Transformers\CategoryTransformer;
use App\Ship\Parents\ApiController as ApiParentController;
use Illuminate\Database\Eloquent\Collection;
use ReflectionException;

class ApiController extends ApiParentController
{
    /**
     * @param  GetAllCategoriesRequest  $request
     * @return mixed
     * @throws ReflectionException
     */
    public function getAllCategories(GetAllCategoriesRequest $request)
    {
        /** @var Collection $categories */
        $categories = $this->call(GetAllCategoriesAction::class, [$request]);

        return $this->transform($categories, CategoryTransformer::class);
    }

    /**
     * @param  GetCategoryByIdRequest  $request
     * @return mixed
     * @throws ReflectionException
     */
    public function getCategoryById(GetCategoryByIdRequest $request)
    {
        /** @var Category $category */
        $category = $this->call(GetCategoryByIdAction::class, [$request]);

        return $this->transform($category, CategoryTransformer::class);
    }

    /**
     * @param  CreateCategoryRequest  $request
     * @return mixed
     * @throws ReflectionException
     */
    public function createCategory(CreateCategoryRequest $request)
    {
        /** @var Category $category */
        $category = $this->call(CreateCategoryAction::class, [$request]);

        return $this->transform($category, CategoryTransformer::class);
    }

    /**
     * @param  UpdateCategoryRequest  $request
     * @return mixed
     * @throws ReflectionException
     */
    public function updateCategory(UpdateCategoryRequest $request)
    {
        /** @var Category $category */
        $category = $this->call(UpdateCategoryAction::class, [$request]);

        return $this->transform($category, CategoryTransformer::class);
    }

    /**
     * @param  DeleteCategoryRequest  $request
     * @return mixed
     * @throws ReflectionException
     */
    public function deleteCategory(DeleteCategoryRequest $request)
    {
        /** @var Category $category */
        $category = $this->call(DeleteCategoryAction::class, [$request]);

        return $this->transform($category, CategoryTransformer::class);
    }
}
