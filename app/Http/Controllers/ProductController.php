<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Services\ProductService;
use Illuminate\Http\Request;
use App\Notifications\ProductNotifier;
use Illuminate\Support\Facades\Notification;
use Auth;
class ProductController extends Controller
{
    protected $productService;
 

    /**
     * ProductController constructor.
     *
     * @param \App\Services\ProductService $productService
     */
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
        
    }

    /**
     * @param $request
     *
     * @return \App\Models\Product
     */
    public function createProduct(CreateProductRequest $request)
    {
        $product = $this->productService->createProduct($request->name, $request->price, $request->category_id);
        return $product;
    }

    /**
     * @param       UpdateProductRequest $request
     * 
     *
     * @return mixed
     */
    public function updateProductById(UpdateProductRequest $request)
    {
        $product = $this->productService->updateProductById($request->product_id, $request->all());
        return $product;
    }

    /**
     * @param ProductRequest $request
     *
     * @return mixed
     */
    public function getProduct(ProductRequest $request)
    {
        $product = $this->productService->getProductsByIds(array($request->param('product_id')));
        return $product;
    }

    /**
     * @param ProductRequest $request
     */
    public function deleteProductById(ProductRequest $request)
    {
        $this->productService->deleteProductById($request->product_id);
    }

    /**
     * @param $path
     * @param $productId
     */
    public function addImage($path , $productId){
        $this->imageRepository->createImage($path , $productId, 'App\Models\Product');
    }

    public function updateUserProduct( Request $request){
        $user = Auth::user();
        
        $product = $this->productService->getProductsByIds(array($request->product_id));
        if($request->quantity == 0)
        {
            $user->notify(new ProductNotifier($product , $user));
        }
    }

    public function createUserProduct(Request $request){
        $user = Auth::user();
        $this->productService->addProductToUser($request->product_id,  $user  , $request->quantity);
        return true;
    }
}
