<?php

namespace App\Infrastructure\Repository\User;

use App\Models\User;

interface UserRepositoryInterface
{
    public function getById(int $id);

    public function save(User $user);

    public function delete(User $user);
}
