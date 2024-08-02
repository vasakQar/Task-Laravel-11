<?php

namespace App\Http\Controllers\Api\V1\Auth;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\UserResource;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\Api\V1\Auth\LoginRequest;
use App\Http\Requests\Api\V1\Auth\LogoutRequest;
use App\Http\Requests\Api\V1\Auth\RegisterRequest;
use App\Services\V1\Contracts\UserServiceInterface;

class AuthController extends Controller
{
    protected UserServiceInterface $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    public function register(RegisterRequest $request): JsonResponse
    {
        $user = $this->userService->register($request->validated());

        return response()->json(new UserResource($user), Response::HTTP_CREATED);
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $res = $this->userService->login($request->validated());

        $status = Response::HTTP_OK;
        if (!$res['success']) {
            $status = Response::HTTP_UNAUTHORIZED;
        }

        return response()->json($res['data'], $status);
    }

    public function logout(LogoutRequest $request): JsonResponse
    {
        $this->userService->logout($request->validated());

        return response()->json([
            'message' => 'User has been logged out successfully.'
        ], Response::HTTP_OK);
    }
}
