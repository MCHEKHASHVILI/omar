<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\FirebaseRepository\Interfaces\FirebaseRepositoryInterface;


class FirebaseController extends Controller
{
    private FirebaseRepositoryInterface $firebaseRepository;

    public function __construct(FirebaseRepositoryInterface $firebaseRepository)
    {
        $this->firebaseRepository = $firebaseRepository;
    }

    public function getAllUsers()
    {
        $users = $this->firebaseRepository->getAllUsers();
        echo "<pre>";
        print_R($users);
    }
}
