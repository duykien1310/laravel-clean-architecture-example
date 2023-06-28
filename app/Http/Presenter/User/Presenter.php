<?php

namespace App\Http\Presenter\User;

use App\Models\User;
use League\Fractal\TransformerAbstract;

class Presenter
{
    public static function UserPresenter()
    {
        return new UserPresenter();
    }
}

class UserPresenter extends TransformerAbstract
{
    public function transform($user)
    {
        return [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email
        ];
    }
}
