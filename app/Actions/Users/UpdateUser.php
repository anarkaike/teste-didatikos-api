<?php

namespace App\Actions\Users;

use App\Actions\Action;
use App\Models\User;


class UpdateUser extends Action {
    /**
     * @throws \Exception
     */
    public function handler(...$args): User
    {
        $user = $this->getById(id: $args['id']);
        if(false === $user->fill($args)->update()) {
            throw new \Exception(message: trans(key: 'messages.users.error_updating'));
        }

        // Podemos também criar log aqui e notificação aqui
        return $user;
    }

    private function getById(int $id): User
    {
        $user = User::find(id: $id);
        if (!$user) {
            throw new \Exception(message: trans(key: 'messages.users.not_found'));
        }

        return $user;
    }
}
