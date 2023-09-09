<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Resources\User\UserResource;
use App\Repositories\UsersRepository\Interfaces\UsersRepositoryInterface;
use App\Repositories\FirebaseRepository\Interfaces\FirebaseRepositoryInterface;
use Illuminate\Http\Request;

/*
 * Filename: d:\laragon\www\FitBite_website\app\Http\Controllers\UserController.php
 * Path: d:\laragon\www\FitBite_website
 * Created Date: Friday, June 16th 2023, 2:45:15 pm
 * Author: Ghulam Rasool
 *
 * Copyright (c) 2023 Your Company
 */

class UserController extends Controller
{
    private UsersRepositoryInterface $usersRepository;
    private $firebaseRepository;

    public function __construct(UsersRepositoryInterface $usersRepository, FirebaseRepositoryInterface $firebaseRepository)
    {
        $this->usersRepository = $usersRepository;
        $this->firebaseRepository = $firebaseRepository;
    }

    public function store(StoreUserRequest $storeUserRequest)
    {

        $whereArray = [
            'uid' => [
                'operator' => 'equals',
                 'value' => $storeUserRequest->input("uid"),
             ]
         ];
        // get category based docs
         $getUserUsingUID = $this->firebaseRepository->get(config('constants.USERS.COLLECTION'), null, 'id', 'DESC', null, $whereArray, null, null, 1);

        $storeUser = $this->usersRepository->storeUser($storeUserRequest->all());
       //  return json_encode($storeUser);
        // // echo "<pre>";
        // print_r($getUserUsingUID);

         if (empty($getUserUsingUID)) {
            echo $storeUserRequest->input("uid");
            echo "Lets insert data";
             $storeUser = $this->usersRepository->storeUser($storeUserRequest->all());
         //   return json_encode($storeUser);
        } else {
            echo $storeUserRequest->input("uid");
            echo "go on";
        } 
         //return true;

        $storeUser = $this->usersRepository->storeUser($storeUserRequest->all());
        return json_encode($storeUser);
    }

    public function update(Request $request)
    {
        unset($request['_token']);
        // Call the repository method to update the recipe
        $updated = $this->usersRepository->updateSingleUser($request);
        // Redirect back with a message
        if ($updated) {
            echo json_encode(array('success' => true, 'msg' => 'User data updated successfully'));
        } else {
            echo json_encode(array('success' => false, 'msg' => 'Failed to updated user'));
        }
    }

    public function uploadProfileImage(Request $request)
    {
        unset($request['_token']);
        // Call the repository method to update the recipe
        return $this->usersRepository->updateUserProfilePic($request);
    }
}
