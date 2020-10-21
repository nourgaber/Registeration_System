<?php
namespace App\Repositories;

use App\Models\Category;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CategoryRepository
{
    /**
     * @param $title
     *
     * @return \App\Models\Category
     */
    public function createCategory($title)
    {
        $category = new Category;
        $category->title = $title;
        $category->save();
        return $category;
    }

    /**
     * @param       $categoryId
     * @param array $options
     *
     * @return mixed
     */
    public function updateCategoryById($categoryId, array $options)
    {
        $category = Category::where('id', $categoryId)->update($options);
        return $category;
    }

    /**
     * @param array $categoryIds
     *
     * @return mixed
     */
    public function getCategoriesByIds(array $categoryIds)
    {
        $categories = Category::whereIn('id', $categoryIds)->get();
        return $categories;
    }

    /**
     * @param $categoryId
     */
    public function deleteCategoryById($categoryId)
    {
        Category::where('id', $categoryId)->delete();
    }
}
