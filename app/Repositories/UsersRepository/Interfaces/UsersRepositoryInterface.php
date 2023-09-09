<?php

namespace App\Repositories\UsersRepository\Interfaces;

use Illuminate\Http\JsonResponse;

interface UsersRepositoryInterface
{
    public function storeUser($request);
    public function getAllUsers();
    public function updateSingleUser($request);
    public function updateUserProfilePic($request);
}
