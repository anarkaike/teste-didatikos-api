<?php

namespace App\Actions\Cities;

use App\Actions\Action;
use App\Models\City;


class UpdateCity extends Action {
    /**
     * @throws \Exception
     */
    public function handler(...$args): City
    {
        $city = $this->getById(id: $args['id']);
        if(false === $city->fill($args)->update()) {
            throw new \Exception(message: trans(key: 'messages.citys.error_updating'));
        }

        // Podemos também criar log aqui e notificação aqui
        return $city;
    }

    private function getById(int $id): City
    {
        $city = City::find(id: $id);
        if (!$city) {
            throw new \Exception(message: trans(key: 'messages.cities.not_found'));
        }

        return $city;
    }
}
