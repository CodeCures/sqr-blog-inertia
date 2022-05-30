<?php 

namespace App\Actions\Auth;

use App\Models\User;

class CreateUser
{
    /**
     * execute
     *
     * @param  mixed $request
     * @return User
     */
    public function execute($data)
    {
        $user = User::create($data);

        $this->login($user);
    }

    private function login($user)
    {
        auth()->login($user);
    }

}
