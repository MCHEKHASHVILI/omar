<?php

namespace App\Repositories\HomeRepository;

use App\FirebaseCloudConnection;
use App\Repositories\FirebaseRepository\Interfaces\FirebaseRepositoryInterface;
use App\Repositories\HomeRepository\Interfaces\HomeRepositoryInterface;
use Illuminate\Http\Request;

class HomeRepository implements HomeRepositoryInterface
{
    protected $firebaseCloudStorage;
    private $firebaseRepository;

    public function __construct(FirebaseCloudConnection $firebaseCloudConnection, FirebaseRepositoryInterface $firebaseRepository)
    {
        $this->firebaseCloudStorage = $firebaseCloudConnection->getFirebaseCloudStorage();
        $this->firebaseRepository = $firebaseRepository;
    }
    public function search($keyword = "")
    {
        $whereArrayRecipe = [
            'title' => [
                'operator' => 'contains',
                'value' => $keyword
            ]
        ];
        $recipes = $this->firebaseRepository->get('recipes', NULL, 'id', 'DESC', null, $whereArrayRecipe);

        $whereArrayTraining = [
            'title' => [
                'operator' => 'contains',
                'value' => $keyword
            ]
        ];
        $trainings = $this->firebaseRepository->get('trainings', NULL, 'id', 'DESC', null, $whereArrayTraining);

        return array_merge($recipes, $trainings);
    }
}
