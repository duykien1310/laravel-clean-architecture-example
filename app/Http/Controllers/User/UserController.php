<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Models\User;
use App\UseCase\User\UserUseCase;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Laravel\Sanctum\PersonalAccessTokenFactory;
use Laravel\Sanctum\Sanctum;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserUseCase $userService)
    {
        $this->userService = $userService;
    }

    public function show(Request $request)
    {
        $id = $request->input('userId');
        $user = $this->userService->getById($id);
        if (!$user) {
            return response()->json(['error' => 'User not found.'], 404);
        }
        $data = Common::convertUserModelToPresenter($user);

        $response = [
            'status' => strval(Response::HTTP_OK),
            'message' => 'SUCCESS',
            'results' => $data
        ];

        return response()->json($response);
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

    public function update(Request $request)
    {
        $id = $request->input('userId');
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

    public function destroy(Request $request)
    {
        $id = $request->input('userId');
        $result = $this->userService->delete($id);
        if ($result) {
            return response()->json(['success' => true]);
        }
        return response()->json(['error' => 'User not found.'], 404);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('API Token')->plainTextToken;

            return response()->json(['token' => $token], 200);
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logged out successfully'], 200);
    }
}
