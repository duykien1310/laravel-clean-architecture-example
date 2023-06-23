<?php

namespace App\UseCase\User;

use App\UseCase\User\UserUseCase;
use App\Models\User;
use App\Infrastructure\Repository\User\UserRepositoryInterface;

class UserService implements UserUseCase
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getById(int $id): ?User
    {
        return $this->userRepository->getById($id);
    }

    public function create(User $user): User
    {
        return $this->userRepository->save($user);
    }

    public function update(int $id, User $data): User
    {
        $user = $this->userRepository->getById($id);

        if ($data->name != null) {
            $user->name = $data->name;
        }

        if ($data->email != null) {
            $user->email = $data->email;
        }

        if ($data->password != null) {
            $user->password = $data->password;
        }

        if ($user) {
            return $this->userRepository->save($user);
        }
        return null;
    }

    public function delete(int $id): bool
    {
        $user = $this->userRepository->getById($id);
        if ($user) {
            return $this->userRepository->delete($user);
        }
        return false;
    }
}
