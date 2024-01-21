<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Actions\Cities\{
    DeleteCity,
    StoreCity,
    UpdateCity,
};
use App\Http\{
    Requests\StoreCityRequest,
    Requests\UpdateCityRequest,
    Responses\ApiErrorResponse,
    Responses\ApiSuccessResponse,
};


class CityController extends Controller
{
    /**
     * Listagem de produtos
     */
    public function index()
    {
        try {
            $cities = City::all();

            return new ApiSuccessResponse(
                data: $cities->toArray(),
                message: trans(key: 'messages.cities.listing_successfully')
            );
        } catch (\Exception $e) {
            return new ApiErrorResponse(exception: $e);
        }
    }

    /**
     * Insere um produto
     */
    public function store(StoreCityRequest $request)
    {
        try {
            $city = StoreCity::run(...$request->validationData());

            return new ApiSuccessResponse(
                data: $city->toArray(),
                message: trans(key: 'messages.cities.creating_successfully')
            );
        } catch (\Exception $e) {
            return new ApiErrorResponse(exception: $e);
        }
    }

    /**
     * Obtem um produto
     */
    public function show(City $city)
    {
        try {
            return new ApiSuccessResponse(
                data: $city->toArray(),
                message: trans(key: 'messages.cities.getting_successfully')
            );
        } catch (\Exception $e) {
            return new ApiErrorResponse(exception: $e);
        }
    }

    /**
     * Atualiza um produto
     */
    public function update(UpdateCityRequest $request, City $city)
    {
        try {
            $cityData = $request->validationData();
            if (!isset($cityData['id'])) $cityData['id'] = $city->id;
            $city = UpdateCity::run(...$cityData);

            return new ApiSuccessResponse(
                data: $city->toArray(),
                message: trans(key: 'messages.cities.updating_successfully')
            );
        } catch (\Exception $e) {
            return new ApiErrorResponse(exception: $e);
        }
    }

    /**
     * Remove um produto
     */
    public function destroy(City $city)
    {
        try {
            DeleteCity::run(...$city->toArray());

            return new ApiSuccessResponse(message: trans(key: 'messages.cities.deleting_successfully'));
        } catch (\Exception $e) {
            return new ApiErrorResponse(exception: $e);
        }
    }
}
