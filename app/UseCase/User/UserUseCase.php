<?php

namespace App\UseCase\User;

use App\Models\User;


interface UserUseCase
{
    public function getById(int $id);

    public function create(User $user): User;

    public function update(int $id, User $data): User;

    public function delete(int $id): bool;
}
