<?php

namespace App\Actions\Products;

use App\Actions\Action;
use App\Models\Product;


class StoreProduct extends Action {
    /**
     * @throws \Exception
     */
    public function handler(...$args): Product
    {
        $product = Product::create(attributes: $args);
        if (!$product) {
            throw new \Exception(message: trans(key: 'messages.products.error_inserting'));
        }

        // Podemos criar log aqui e notificação
        return $product;
    }
}
