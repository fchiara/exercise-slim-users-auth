<?php

namespace App\Serializers;

use App\Models\User;

class UserSerializer
{
    public function build(User $obj): array
    {
        return [
            'data' => [
                'type' => 'users',
                'id' => $obj->getId(),
                'attributes' => [
                    'username' => $obj->getUsername(),
                    'firstName' => $obj->getFirstName(),
                    'lastName' => $obj->getLastName(),
                    'birthday' => $obj->getBirthday()->format('Y-m-d'),
                ],
            ]
        ];
    }

}