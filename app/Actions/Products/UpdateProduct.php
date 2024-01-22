<?php

namespace App\Actions\Products;

use App\Actions\Action;
use App\Models\Product;


class UpdateProduct extends Action {
    /**
     * @throws \Exception
     */
    public function handler(...$args): Product
    {
        $product = $this->getById(id: $args['id']);
        if(false === $product->update($args)) {
            throw new \Exception(message: trans(key: 'messages.products.error_updating'));
        }

        // Podemos também criar log aqui e notificação aqui
        return $product;
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
