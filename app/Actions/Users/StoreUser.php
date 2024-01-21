<?php

namespace App\Actions\Users;

use App\Actions\Action;
use App\Models\User;


class StoreUser extends Action {
    /**
     * @throws \Exception
     */
    public function handler(...$args): User
    {
        $user = User::create(attributes: $args);
        if (!$user) {
            throw new \Exception(message: trans(key: 'messages.users.error_inserting'));
        }

        // Podemos criar log aqui e notificação
        return $user;
    }
}
