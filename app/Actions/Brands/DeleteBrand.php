<?php

namespace App\Actions\Brands;

use App\Actions\Action;
use App\Models\Brand;


class DeleteBrand extends Action {
    /**
     * @throws \Exception
     */
    public function handler(...$args): bool
    {
        if(!$this->getById(id: $args['id'])->delete()) {
            throw new \Exception(message: trans(key: 'messages.brand.error_deleting'));
        }

        // Podemos criar log aqui e notificação
        return true;
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
