<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\UseCase\User\UserUseCase;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserUseCase $userService)
    {
        $this->userService = $userService;
    }

    public function show(int $id)
    {
        $user = $this->userService->getById($id);
        return response()->json($user);
    }

    public function store(Request $request)
    {
        $user = new User;
        $user->name = $request->name;
        $user->password = $request->password;
        $user->email = $request->email;
        $user = $this->userService->create($user);
        return response()->json($user, 201);
    }

    public function update(Request $request, int $id)
    {
        $user = new User;
        $user->name = $request->name;
        $user->password = $request->password;
        $user->email = $request->email;

        $user = $this->userService->update($id, $user);
        if ($user) {
            return response()->json($user);
        }
        return response()->json(['error' => 'User not found.'], 404);
    }

    public function destroy(int $id)
    {
        $result = $this->userService->delete($id);
        if ($result) {
            return response()->json(['success' => true]);
        }
        return response()->json(['error' => 'User not found.'], 404);
    }
}
