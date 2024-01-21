<?php

namespace App\Actions\Cities;

use App\Actions\Action;
use App\Models\City;


class DeleteCity extends Action {
    /**
     * @throws \Exception
     */
    public function handler(...$args): bool
    {
        if(!$this->getById($args['id'])->delete()) {
            throw new \Exception(message: trans(key: 'messages.cities.error_deleting'));
        }

        // Podemos criar log aqui e notificação
        return true;
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
