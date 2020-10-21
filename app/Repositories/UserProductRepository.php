<?php

namespace App\Repositories;

use App\Models\UserProduct;


class UserProductRepository
{
    /**
     * @param $name
     * @param $price
     * @param $categoryId
     *
     * @return \App\Models\UserProduct
     */
    public function createUserProduct($userId, $productId, $quantity)
    {
        $userProduct = new UserProduct;
        $userProduct->user_id = $userId;
        $userProduct->product_id = $productId;
        $userProduct->quantity = $quantity;
        $userProduct->save();
        return $userProduct;
    }

    /**
     * @param       $userId
     * @param       $productId
     * 
     * @param array $options
     *
     * @return mixed
     */
    public function updateUserProductByIds($userId, $productId , $quantity)
    {
        $userProduct = UserProduct::where('product_id', $productId)->where('user_id', $userId)->update(array('quantity' => $quantity));
        return $userProduct;
    }

    /**
     * @param array $userProductIds
     *
     * @return mixed
     */
    public function getUserProductsByIds(array $userProductIds)
    {
        $userProducts = UserProduct::whereIn('id', $userProductIds)->get();
        return $userProducts;
    }

    /**
     * @param $userProductId
     */
    public function deleteUserProductById($userProductId)
    {
        UserProduct::where('id', $userProductId)->delete();
    }

}
