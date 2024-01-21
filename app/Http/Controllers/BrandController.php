<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Actions\Brands\{
    DeleteBrand,
    StoreBrand,
    UpdateBrand,
};
use App\Http\{
    Requests\StoreBrandRequest,
    Requests\UpdateBrandRequest,
    Responses\ApiErrorResponse,
    Responses\ApiSuccessResponse,
};


class BrandController extends Controller
{
    /**
     * Listagem de produtos
     */
    public function index()
    {
        try {
            $brands = Brand::all();

            return new ApiSuccessResponse(
                data: $brands->toArray(),
                message: trans(key: 'messages.brands.listing_successfully')
            );
        } catch (\Exception $e) {
            return new ApiErrorResponse(exception: $e);
        }
    }

    /**
     * Insere um produto
     */
    public function store(StoreBrandRequest $request)
    {
        try {
            $brand = StoreBrand::run(...$request->validationData());

            return new ApiSuccessResponse(
                data: $brand->toArray(),
                message: trans(key: 'messages.brands.creating_successfully')
            );
        } catch (\Exception $e) {
            return new ApiErrorResponse(exception: $e);
        }
    }

    /**
     * Obtem um produto
     */
    public function show(Brand $brand)
    {
        try {
            return new ApiSuccessResponse(
                data: $brand->toArray(),
                message: trans(key: 'messages.brands.getting_successfully')
            );
        } catch (\Exception $e) {
            return new ApiErrorResponse(exception: $e);
        }
    }

    /**
     * Atualiza um produto
     */
    public function update(UpdateBrandRequest $request, Brand $brand)
    {
        try {
            $brandData = $request->validationData();
            if (!isset($brandData['id'])) $brandData['id'] = $brand->id;
            $brand = UpdateBrand::run(...$brandData);

            return new ApiSuccessResponse(
                data: $brand->toArray(),
                message: trans(key: 'messages.brands.updating_successfully')
            );
        } catch (\Exception $e) {
            return new ApiErrorResponse(exception: $e);
        }
    }

    /**
     * Remove um produto
     */
    public function destroy(Brand $brand)
    {
        try {
            DeleteBrand::run(...$brand->toArray());

            return new ApiSuccessResponse(message: trans(key: 'messages.brands.deleting_successfully'));
        } catch (\Exception $e) {
            return new ApiErrorResponse(exception: $e);
        }
    }
}
