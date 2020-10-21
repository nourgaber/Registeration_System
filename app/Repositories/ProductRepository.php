<?php

namespace App\Repositories;

use App\Models\Product;


class ProductRepository
{
    /**
     * @param $name
     * @param $price
     * @param $categoryId
     *
     * @return \App\Models\Product
     */
    public function createProduct($name, $price, $categoryId)
    {
        $product = new Product;
        $product->name = $name;
        $product->price = $price;
        $product->category_id = $categoryId;
        $product->save();
        return $product;
    }

    /**
     * @param       $productId
     * @param array $options
     *
     * @return mixed
     */
    public function updateProductById($productId, array $options)
    {
        $product = Product::where('id', $productId)->update($options);
        return $product;
    }

    /**
     * @param array $productIds
     *
     * @return mixed
     */
    public function getProductsByIds(array $productIds)
    {
        $products = Product::whereIn('id', $productIds)->get();
        return $products;
    }

    /**
     * @param $productId
     */
    public function deleteProductById($productId)
    {
        Product::where('id', $productId)->delete();
    }

}
