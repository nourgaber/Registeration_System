<?php

namespace App\Services;

use App\Models\Category;
use App\Repositories\CategoryRepository;
use App\Repositories\ImageRepository;

/**
 * Class CategoryService
 * This class contains category actions
 * @package App\Services
 */
class CategoryService
{
    protected $categoryRepository;
    protected $imageRepository;

    /**
     * CategoryService constructor.
     *
     * @param \App\Repositories\CategoryRepository $categoryRepository
     * @param \App\Repositories\ImageRepository    $imageRepository
     */
    public function __construct(CategoryRepository $categoryRepository, ImageRepository $imageRepository)
    {
        $this->categoryRepository = $categoryRepository;
        $this->imageRepository = $imageRepository;
    }

    /**
     * @param $title
     *
     * @return \App\Models\Category
     */
    public function createCategory($title)
    {
        $category = $this->categoryRepository->createCategory($title);
        return $category;
    }

    /**
     * @param       $id
     * @param array $options
     *
     * @return mixed
     */
    public function updateCategoryById($id, array $options)
    {
        $categoryOptions = array();
        if(!is_null($options['title'])){
            $categoryOptions['title'] = $options['title'];
        }

        $category = $this->categoryRepository->updateCategoryById($id, $categoryOptions);
        return $category;

    }

    /**
     * @param array $categoryIds
     *
     * @return mixed
     */
    public function getCategoriesByIds(array $categoryIds)
    {
        $categories = $this->categoryRepository->getCategoriesByIds($categoryIds);
        return $categories;
    }

    /**
     * @param $categoryId
     */
    public function deleteCategoryById($categoryId)
    {
        $this->categoryRepository->deleteCategoryById($categoryId);
    }

    /**
     * @param $path
     * @param $productId
     */
    public function addImage($path , $productId){
        $this->imageRepository->createImage($path , $productId, 'App\Models\Category');
    }
}
