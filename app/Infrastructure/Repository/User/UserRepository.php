<?php

namespace App\Infrastructure\Repository\User;

use App\Models\User;
use App\Infrastructure\Repository\User\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    public function getById(int $id): ?User
    {
        return User::find($id);
    }

    public function create(User $user): User
    {
        $user->save();
        return $user;
    }

    public function update(User $user): User
    {
        $user->save();
        return $user;
    }

    public function delete(User $user): bool
    {
        return $user->delete();
    }
}
