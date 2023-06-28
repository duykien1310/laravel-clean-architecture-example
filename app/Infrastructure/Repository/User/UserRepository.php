<?php

namespace App\Infrastructure\Repository\User;

use App\Models\User;
use App\Infrastructure\Repository\User\UserRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserRepository implements UserRepositoryInterface
{
    public function getById(int $id)
    {
        return $user = User::find($id);
    }

    public function save(User $user)
    {
        return $user->save();
    }

    public function delete(User $user)
    {
        return $user->delete();
    }
}
