<?php

namespace App\Actions\Users;

use App\Actions\Action;
use App\Models\User;


class DeleteUser extends Action {
    public function handler(...$args): bool
    {
        if(!$this->getById(id: $args['id'])->delete()) {
            throw new \Exception(message: trans(key: 'messages.users.error_deleting'));
        }

        // Podemos criar log aqui e notificação
        return true;
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
