<?php

namespace App\Services\V1;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Services\V1\Contracts\UserServiceInterface;
use App\Repositories\V1\Contracts\CRUDRepositoryInterface;

class UserService implements UserServiceInterface
{
    protected CRUDRepositoryInterface $userRepository;

    public function __construct(CRUDRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }


    public function register(array $inputs): Model|Builder
    {
        $data = [
            'name' => $inputs['name'],
            'email' => $inputs['email'],
            'password' => Hash::make($inputs['password'])
        ];

        return $this->userRepository->create($data);
    }

    public function login(array $inputs): array
    {
        if (!Auth::attempt(['email' => $inputs['email'], 'password' => $inputs['password']])) {
            return [
                'success' => false,
                'data' => [
                    'message' => 'Incorrect data!'
                ]
            ];
        }

        $user = Auth::user();
        $token = $user->createToken('auth_token')->plainTextToken;

        return [
            'success' => 'true',
            'data' => [
                'message' => 'User has been logged in successfully!',
                'access_token' => $token,
                'token_type' => 'Bearer'
            ]
        ];
    }

    public function logout(array $inputs): int
    {
        $isAllDevices = $inputs['all_devices'] ?? false;

        $user = Auth::user();

        if ($isAllDevices) {
            return $user->tokens()->delete();
        }

        return $user->currentAccessToken()->delete();
    }
}
