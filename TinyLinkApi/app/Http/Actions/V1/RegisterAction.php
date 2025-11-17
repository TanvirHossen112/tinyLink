<?php

namespace App\Http\Actions\V1;

use App\Models\User;

class RegisterAction
{
    /**
     * Register user
     *
     * @param array $fields
     * @return User
     */
    public function execute(array $fields): User
    {
        return User::create($fields);
    }
}
