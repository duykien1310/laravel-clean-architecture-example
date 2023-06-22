<?php

namespace App\Infrastructure\Repository\User;

use App\Models\User;

interface UserRepositoryInterface
{
    public function getById(int $id): ?User;

    public function create(User $user): User;

    public function update(User $user): User;

    public function delete(User $user): bool;
}
