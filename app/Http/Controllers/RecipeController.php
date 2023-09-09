<?php

namespace App\Http\Controllers;

use App\FirebaseCloudConnection;
use App\FirebaseConnection;
use App\Http\Requests\StoreRecipeRequest;
use App\Repositories\FirebaseRepository\Interfaces\FirebaseRepositoryInterface;
use Illuminate\Http\Request;
use App\Repositories\RecipeRepository\{
    Interfaces\RecipeRepositoryInterface
};
// use Form;

/*
 * Filename: d:\laragon\www\FitBite_website\app\Http\Controllers\RecipeController.php
 * Path: d:\laragon\www\FitBite_website
 * Created Date: Friday, June 16th 2023, 2:45:15 pm
 * Author: Ghulam Rasool
 *
 * Copyright (c) 2023 Your Company
 */


class RecipeController extends Controller
{
    private RecipeRepositoryInterface $recipeRepository;
    private $firebaseRepository;
    protected $firebaseConnection;

    public function __construct(
        RecipeRepositoryInterface $recipeRepository,
        FirebaseRepositoryInterface $firebaseRepository,
        FirebaseConnection $firebaseConnection
    ) {
        $this->recipeRepository = $recipeRepository;
        $this->firebaseRepository = $firebaseRepository;
        $this->firebaseConnection = $firebaseConnection->getFirebase();
    }
    /**
     * Display a listing of the resource.
     */

    //  below function for admin
    public function index()
    {
        return view('recipe.admin.index', [
            'recipes' => $this->firebaseRepository->get(config('constants.RECIPES.COLLECTION'), null, 'id', 'DESC', null, null, 1)
        ]);
    }

    public function publicIndex(Request $request, $page = 1)
    {
        $limit = 12;  // adjust to your desired page size

        $searchKeyword = null;
        $whereArrayRecipe = null;
        if ($request->input('keyword') != "") {
            $searchKeyword = $request->input('keyword');

            $whereArrayRecipe = [
                'title' => [
                    'operator' => 'contains',
                    'value' => $searchKeyword,
                ]
            ];
        }

        $data = $this->firebaseRepository->get(config('constants.RECIPES.COLLECTION'), $limit, null, 'DESC', null, $whereArrayRecipe, $page, $searchKeyword);
        $totalRecords = count($this->firebaseRepository->get(config('constants.RECIPES.COLLECTION'), null, null, 'DESC', null, $whereArrayRecipe, $page, $searchKeyword));

        return view('recipe.index', [
            'recipes' => $data,
            'totalRecords' => $totalRecords,
            'searchKeyword' => $searchKeyword,
            'currentPage' => $page,
            'recordsPerPage' => $limit,

        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('recipe.admin.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRecipeRequest $request)
    {
        unset($request['_token']);
        $storeRecipe = $this->recipeRepository->store($request);
        return redirect(config('constants.RECIPES.ADMIN_RECIPES'))->with('success', 'Recipe has been created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        echo "<pre>";
        $data = $this->recipeRepository->getSingleRecipe($id);
        print_r($data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $getSingleRecipe = $this->recipeRepository->getSingleRecipe($id);

        return view('recipe.admin.edit', ['data' => $getSingleRecipe, 'doc_id' => $id]);


        // echo "Inside edit";
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreRecipeRequest $request, string $id)
    {
        unset($request['_token']);
        // Call the repository method to update the recipe
        $updated = $this->recipeRepository->updateSingleRecipe($request, $id);
        // Redirect back with a message
        if ($updated) {
            return redirect(config('constants.RECIPES.ADMIN_RECIPES'))->with('success', 'Recipe updated successfully');
        } else {
            return back()
                ->withInput()
                ->with('error', 'Failed to update the recipe');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $result = $this->recipeRepository->deleteSingleRecipe($id);
        if ($result) {
            // The delete operation was successful
            return redirect(config('constants.RECIPES.ADMIN_RECIPES'))->with(config('constants.COMMON.SUCCESS'), config('constants.RECIPES.GENERAL.DELETED'));
        } else {
            // The delete operation failed
            return redirect(config('constants.RECIPES.ADMIN_RECIPES'))->with(config('constants.COMMON.ERROR'), config('constants.RECIPES.GENERAL.NOT_DELETED'));
        }
    }

    public function video(Request $request, $document_id = "")
    {
        $getSelectedDocDetail = $this->firebaseRepository->getDocumentById(config('constants.RECIPES.COLLECTION'), (int) $document_id);

        if (isset($getSelectedDocDetail)) {
            $whereArray = [
                'category' => [
                    'operator' => 'equals',
                    'value' => $getSelectedDocDetail['category']
                ]
            ];
            // get category based docs
            $getCategoryBasedRecipes = $this->firebaseRepository->get(config('constants.RECIPES.COLLECTION'), null, 'id', 'DESC', null, $whereArray);
        } else {
            // error page here
        }


        return view('recipe.video', [
            'getSelectedDocDetail' => $getSelectedDocDetail,
            'getCategoryBasedRecipes' => $getCategoryBasedRecipes,
        ]);
    }


    public function categorized(Request $request)
    {
        // get category based docs
        $getRecipes = $this->firebaseRepository->get(config('constants.RECIPES.COLLECTION'), null, 'id', 'DESC', null, null);

        // get chest
        $whereArrayChest = [
            'category' => [
                'operator' => 'equals',
                'value' => 'Chest'
            ]
        ];
        $chest = $this->firebaseRepository->get(config('constants.RECIPES.COLLECTION'), null, 'id', 'DESC', null, $whereArrayChest);

        // get Biceps
        $whereArrayBiCeps = [
            'category' => [
                'operator' => 'equals',
                'value' => 'Biceps'
            ]
        ];
        $biCeps = $this->firebaseRepository->get(config('constants.RECIPES.COLLECTION'), null, 'id', 'DESC', null, $whereArrayBiCeps);

        //Six Pack
        $whereArraySixPack = [
            'category' => [
                'operator' => 'equals',
                'value' => 'Six Pack'
            ]
        ];
        $sixPack = $this->firebaseRepository->get(config('constants.RECIPES.COLLECTION'), null, 'id', 'DESC', null, $whereArraySixPack);

        //Six Pack
        $whereArrayNoEquipment = [
            'category' => [
                'operator' => 'equals',
                'value' => 'No Equipment'
            ]
        ];
        $noEquipment = $this->firebaseRepository->get(config('constants.RECIPES.COLLECTION'), null, 'id', 'DESC', null, $whereArrayNoEquipment);

        // get firebase cloud connection got allocate signed url
        $firebaseCloudConnection = new FirebaseCloudConnection();

        return view('recipe.categorized', [
            'recipes' => $getRecipes,
            'chest' => $chest,
            'biCeps' => $biCeps,
            'sixPack' => $sixPack,
            'noEquipment' => $noEquipment,
            'firebaseCloudConnection' => $firebaseCloudConnection
        ]);
    }
}
