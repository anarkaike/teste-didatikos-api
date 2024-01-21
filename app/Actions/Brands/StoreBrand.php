<?php

namespace App\Actions\Brands;

use App\Actions\Action;
use App\Models\Brand;


class StoreBrand extends Action {
    /**
     * @throws \Exception
     */
    public function handler(...$args): Brand
    {
        $brand = Brand::create(attributes: $args);
        if (!$brand) {
            throw new \Exception(message: trans(key: 'messages.brands.error_inserting'));
        }

        // Podemos criar log aqui e notificação
        return $brand;
    }
}
