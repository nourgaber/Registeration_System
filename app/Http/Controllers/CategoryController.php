<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $categoryService;
 

    /**
     * CategoryController constructor.
     *
     * @param \App\Services\CategoryService $categoryService
     */
    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
        
    }

    /**
     * @param $request
     *
     * @return \App\Models\Category
     */
    public function createCategory(CreateCategoryRequest $request)
    {
        $category = $this->categoryService->createCategory($request->title);
        return $category;
    }

    /**
     * @param       $id
     * @param array $options
     *
     * @return mixed
     */
    public function updateCategoryById(UpdateCategoryRequest $request)
    {
        $category = $this->categoryService->updateCategoryById($request->category_id, $request->all());
        return $category;
    }

    /**
     * @param array $categoryIds
     *
     * @return mixed
     */
    public function getCategory(CategoryRequest $request)
    {
        $categories = $this->categoryService->getCategoriesByIds(array($request->param('category_id')));
        return $categories;
    }

    /**
     * @param $categoryId
     */
    public function deleteCategoryById(CategoryRequest $request)
    {
        $this->categoryService->deleteCategoryById($request->category_id);
    }

    /**
     * @param $path
     * @param $productId
     */
    public function addImage($path , $productId){
        $this->imageRepository->createImage($path , $productId, 'App\Models\Category');
    }
}
