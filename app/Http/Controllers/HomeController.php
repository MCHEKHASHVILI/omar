<?php

namespace App\Http\Controllers;

use App\FirebaseCloudConnection;
use App\FirebaseConnection;
use App\Isop\Isop as IsopIsop;
use App\Repositories\FirebaseRepository\Interfaces\FirebaseRepositoryInterface;
use App\Repositories\HomeRepository\Interfaces\HomeRepositoryInterface;
use Illuminate\Http\Request;
use Isop;
use Illuminate\Support\Facades\Cookie;

/*
 * Filename: d:\laragon\www\FitBite_website\app\Http\Controllers\HomeController.php
 * Path: d:\laragon\www\FitBite_website
 * Created Date: Friday, June 16th 2023, 2:45:15 pm
 * Author: Ghulam Rasool
 *
 * Copyright (c) 2023 Your Company
 */


class HomeController extends Controller
{

    private $firebaseRepository;
    private $homeRepository;
    // protected $firebaseCloudStorage;


    public function __construct(FirebaseRepositoryInterface $firebaseRepository, HomeRepositoryInterface $homeRepository)
    {
        // $this->firebaseCloudStorage = $firebaseCloudConnection->getFirebaseCloudStorage();
        $this->firebaseRepository = $firebaseRepository;
        $this->homeRepository = $homeRepository;
    }

    public function index()
    {
        $firebaseCloudConnection = new FirebaseCloudConnection();
        $where = [
            'id' => 1
        ];
        // public function get($collection, $limit = null, $orderBy = null, $sortOrder = 'ASC', $whereId = null, $whereArray = null)
        return view('home', [
            'recipes' => $this->firebaseRepository->get(config('constants.RECIPES.COLLECTION'), 5, 'id', 'DESC', null, null, 1),
            'trainings' => $this->firebaseRepository->get(config('constants.TRAININGS.COLLECTION'), 5, 'id', 'DESC', null, null, 1),
            'firebaseCloudConnection' => $firebaseCloudConnection
        ]);
    }

    public function profile()
    {

        $encryptedUid = Cookie::get('uid');
   
          
        $documentID = "";
        $getUserDocument = $this->firebaseRepository->getDocumentByKeyValue(config('constants.USERS.COLLECTION'), 'uid', $encryptedUid, true);
        if (!empty($getUserDocument)) {
            $documentID = $getUserDocument[0];
        }

        $data = "";
        if ($documentID) {
            $data = $this->firebaseRepository->getDocument(config('constants.USERS.COLLECTION'), $documentID);
        }

        // echo "<pre>";
        // print_r($data);
        // die();
        return view('profile', ['data' => $data]);
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        $firebaseCloudConnection = new FirebaseCloudConnection();
        // echo "<pre>";
        // print_R($this->homeRepository->search($keyword));
        // die();
        // Return the search recipes view with the data
        return view('search', [
            'cards' => $this->homeRepository->search($keyword),
            'keyword' => $keyword,
            'firebaseCloudConnection' => $firebaseCloudConnection
        ]);
    }
    public function logout(){
      Cookie::forget('uid');
        return  redirect()->to(url('/'));    
      //return Cookie::get();  
   }
}
