<?php

namespace App\Actions\Brands;

use App\Actions\Action;
use App\Models\Brand;


class UpdateBrand extends Action {
    /**
     * @throws \Exception
     */
    public function handler(...$args): Brand
    {
        $brand = $this->getById(id: $args['id']);
        if(false === $brand->fill($args)->update()) {
            throw new \Exception(message: trans(key: 'messages.brands.error_updating'));
        }

        // Podemos também criar log aqui e notificação aqui
        return $brand;
    }

    private function getById(int $id): Brand
    {
        $brand = Brand::find(id: $id);
        if (!$brand) {
            throw new \Exception(message: trans(key: 'messages.brands.not_found'));
        }

        return $brand;
    }
}
