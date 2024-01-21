<?php

namespace App\Actions\Cities;

use App\Actions\Action;
use App\Models\City;


class StoreCity extends Action {
    /**
     * @throws \Exception
     */
    public function handler(...$args): City
    {
        $city = City::create(attributes: $args);
        if (!$city) {
            throw new \Exception(message: trans(key: 'messages.citys.error_inserting'));
        }

        // Podemos criar log aqui e notificação
        return $city;
    }
}
