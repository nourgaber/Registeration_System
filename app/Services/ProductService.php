<?php

namespace App\Services;

use App\Models\Product;
use App\Repositories\ImageRepository;
use App\Repositories\ProductRepository;
use App\Repositories\UserProductRepository;

/**
 * Class ProductService
 * This class contains product actions
 * @package App\Services
 */
class ProductService
{
    protected $productRepository;
    protected $imageRepository;
    protected $userService;
    protected $userProductRepository;


    /**
     * ProductService constructor.
     *
     * @param \App\Repositories\ProductRepository $productRepository
     * @param \App\Repositories\ImageRepository   $imageRepository
     */
    public function __construct(ProductRepository $productRepository, ImageRepository $imageRepository, UserService $userService, UserProductRepository $userProductRepository)
    {
        $this->productRepository = $productRepository;
        $this->imageRepository = $imageRepository;
        $this->userService = $userService;
        $this->userProductRepository = $userProductRepository;

    }

    /**
     * @param $name
     * @param $price
     * @param $categoryId
     *
     * @return \App\Models\Product
     */
    public function createProduct($name , $price, $categoryId)
    {
        $product = $this->productRepository->createProduct($name , $price, $categoryId);
        return $product;
    }

    /**
     * @param       $id
     * @param array $options
     *
     * @return mixed
     */
    public function updateProductById($id, array $options)
    {
        $productOptions = array();
        if(isset($options['name'])){
            $productOptions['name'] = $options['name'];
        }
        if(isset($options['price'])){
            $productOptions['price'] = $options['price'];
        }
         if(isset($options['categoryId'])){
            $productOptions['category_id'] = $options['categoryId'];
        }
        $product = $this->productRepository->updateProductById($id, $productOptions);
        return $product;

    }

    /**
     * @param array $productIds
     *
     * @return mixed
     */
    public function getProductsByIds(array $productIds)
    {
        $products = $this->productRepository->getProductsByIds($productIds);
        return $products;
    }

    /**
     * @param $productId
     */
    public function deleteProductById($productId)
    {
        $this->productRepository->deleteProductById($productId);
    }

    /**
     * @param $path
     * @param $productId
     */
    public function addImage($path , $productId){
        $this->imageRepository->createImage($path , $productId, 'App\Models\Product');
    }

    /**
     * @param $productId
     * @param $userId
     * @param $quantity
     */
    public function addProductToUser($productId, $user, $quantity){
    
        $product = $this->productRepository->getProductsByIds(array($productId));
        if(count($product) < 1){
            return false;
        }
    
        return $this->userProductRepository->createUserProduct($user->id, $productId, $quantity);
        
    }

    /**
     * @param $productId
     * @param $userId
     * @param $quantity
     */
    public function updateUserProduct($productId, $user, $quantity){
    
    
        return $this->userProductRepository->updateUserProductByIds($user->id, $productId, $quantity);
        
    }

    /**
     * @param $productId
     *
     * @return string
     */
    public function deleteProduct($productId)
    {
        $product = $this->productRepository->getProductsByIds(array($productId));
        if(count($product) < 0){
            return false;
        }
        $users = $product->users;
        $this->productRepository->deleteProductById($productId);

        $product->users()->detach($users);

        return true;
    }
}
