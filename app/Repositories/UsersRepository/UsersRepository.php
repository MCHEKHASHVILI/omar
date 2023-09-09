<?php

namespace App\Repositories\UsersRepository;

use App\FirebaseCloudConnection;
use App\FirebaseConnection;
use App\Repositories\FirebaseRepository\Interfaces\FirebaseRepositoryInterface;
use App\Repositories\UsersRepository\Interfaces\UsersRepositoryInterface;
use Google\Rpc\Context\AttributeContext\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cookie;
use Isop;
/*
 * Filename: d:\laragon\www\FitBite_website\app\Repositories\UsersRepository\UsersRepository.php
 * Path: d:\laragon\www\FitBite_website
 * Created Date: Saturday, June 17th 2023, 2:24:34 pm
 * Author: Ghulam Rasool
 *
 * Copyright (c) 2023 Your Company
 */

class UsersRepository implements UsersRepositoryInterface
{
    protected $firebaseConnection;
    private $firebaseRepository;
    protected $firebaseCloudStorage;



    public function __construct(FirebaseCloudConnection $firebaseCloudConnection, FirebaseConnection $firebaseConnection, FirebaseRepositoryInterface $firebaseRepository)
    {
        $this->firebaseConnection = $firebaseConnection->getFirebase();
        $this->firebaseRepository = $firebaseRepository;
        $this->firebaseCloudStorage = $firebaseCloudConnection->getFirebaseCloudStorage();
    }

    public function storeUser($request)
    {
        $request = array_merge($request, [
            'username' => "",
            'first_name' => "",
            'last_name' => "",
            "profile_img_url" => "",
            'profile_image_org_name' => "",
            "email" => "",
            "subscription_method" => "",
            "date_of_subscription" => "",
            "expiry_date_of_subscription" => "",
            "subscription_status" => "",
            "created_at" => "",
            "updated_at" => "",
            "deleted_at" => ""
        ]);

        $addUser = $this->firebaseRepository->store(config('constants.USERS.COLLECTION'), $request);
        $response = [
            "success" => true,
            "message" => "User authenticated successfully",
            "data"    => $request,
        ];
        return $response;
    }

    public function getAllUsers()
    {
        $users = $this->firebaseConnection->getReference('users');
        return $users->getvalue();
    }

    public function updateSingleUser($request)
    {

        $documentID = "";
        $getUserDocumentID = $this->firebaseRepository->getDocumentByKeyValue(config('constants.USERS.COLLECTION'), 'uid', $request->input('uid'), true);
        if (!empty($getUserDocumentID)) {
            $documentID = $getUserDocumentID[0];
        }


        $data = [
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
        ];

        return $this->firebaseRepository->updateSingleDocument(config('constants.USERS.COLLECTION'), $documentID, $data);
    }

    public function updateUserProfilePic($request)
    {
        $request->validate([
            'file' => 'required|image|max:2048',  // Validate the file is an image and is not too large
        ]);

        $data = array();
        $imageFilename = "";
        if ($request->hasFile('file')) {
            // Save the image file and add its path to the data array
            $image = $request->file('file');
            // image original file name to show for end user instead of random string
            $imageOrgFilename = $image->getClientOriginalName();
            // Create a unique filename for the image and video
            $imageFilename = config('constants.USERS.IMAGES_PATH') . uniqid() . '.' . $image->getClientOriginalExtension();
            // Upload the file to Firebase Cloud Storage
            $this->firebaseCloudStorage->getBucket()->upload(
                fopen($image->getRealPath(), 'r'),
                ['name' => $imageFilename]
            );

            $data['profile_image_org_name'] = $imageOrgFilename;
            $data['profile_img_url'] = $imageFilename;
        }

        /*         echo "<pre>";
        print_R($data); */


        // Here you can update the image name in your Realtime Database
        $encryptedUid = Cookie::get('uid');
        $documentID = "";
        $getUserDocument = $this->firebaseRepository->getDocumentByKeyValue(config('constants.USERS.COLLECTION'), 'uid', $encryptedUid, true);
        if (!empty($getUserDocument)) {
            $documentID = $getUserDocument[0];
        }

        $this->firebaseRepository->updateSingleDocument(config('constants.USERS.COLLECTION'), $documentID, $data);

        $imageSignedUrl = Isop::generateFirebaseMediaUrl($imageFilename);

        // Return the image URL as response
        return response()->json(['imageUrl' => $imageSignedUrl]);

        // Call the repository method to update the recipe
        // $updated = $this->usersRepository->updateUserProfilePic($request);
    }
}
