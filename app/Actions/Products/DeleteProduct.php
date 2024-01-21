<?php

namespace App\Actions\Products;

use App\Actions\Action;
use App\Models\Product;


class DeleteProduct extends Action {
    /**
     * @throws \Exception
     */
    public function handler(...$args): bool
    {
        if(!$this->getById(id: $args['id'])->delete()) {
            throw new \Exception(message: trans(key: 'messages.products.error_deleting'));
        }

        // Podemos criar log aqui e notificação
        return true;
    }

    private function getById(int $id): Product
    {
        $product = Product::find(id: $id);
        if (!$product) {
            throw new \Exception(message: trans(key: 'messages.products.not_found'));
        }

        return $product;
    }
}
