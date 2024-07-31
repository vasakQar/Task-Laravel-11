<?php

namespace App\Services\V1\Contracts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

interface UserServiceInterface
{
    public function register(array $inputs): Model|Builder;

    public function login(array $inputs): array;

    public function logout(array $inputs): int;
}
