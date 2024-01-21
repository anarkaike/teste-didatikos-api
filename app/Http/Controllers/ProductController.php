<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Actions\Products\{
    DeleteProduct,
    StoreProduct,
    UpdateProduct,
};
use App\Http\{
    Requests\StoreProductRequest,
    Requests\UpdateProductRequest,
    Responses\ApiErrorResponse,
    Responses\ApiSuccessResponse,
};


class ProductController extends Controller
{
    /**
     * Listagem de produtos
     */
    public function index()
    {
        try {
            $products = Product::all();

            return new ApiSuccessResponse(
                data: $products->toArray(),
                message: trans(key: 'messages.products.listing_successfully')
            );
        } catch (\Exception $e) {
            return new ApiErrorResponse(exception: $e);
        }
    }

    /**
     * Insere um produto
     */
    public function store(StoreProductRequest $request)
    {
        try {
            $product = StoreProduct::run(...$request->validationData());

            return new ApiSuccessResponse(
                data: $product->toArray(),
                message: trans(key: 'messages.products.creating_successfully')
            );
        } catch (\Exception $e) {
            return new ApiErrorResponse(exception: $e);
        }
    }

    /**
     * Obtem um produto
     */
    public function show(Product $product)
    {
        try {
            return new ApiSuccessResponse(
                data: $product->toArray(),
                message: trans(key: 'messages.products.getting_successfully')
            );
        } catch (\Exception $e) {
            return new ApiErrorResponse(exception: $e);
        }
    }

    /**
     * Atualiza um produto
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        try {
            $productData = $request->validationData();
            if (!isset($productData['id'])) $productData['id'] = $product->id;
            $product = UpdateProduct::run(...$productData);

            return new ApiSuccessResponse(
                data: $product->toArray(),
                message: trans(key: 'messages.products.updating_successfully')
            );
        } catch (\Exception $e) {
            return new ApiErrorResponse(exception: $e);
        }
    }

    /**
     * Remove um produto
     */
    public function destroy(Product $product)
    {
        try {
            DeleteProduct::run(...$product->toArray());

            return new ApiSuccessResponse(message: trans(key: 'messages.products.deleting_successfully'));
        } catch (\Exception $e) {
            return new ApiErrorResponse(exception: $e);
        }
    }
}
