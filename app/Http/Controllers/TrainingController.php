<?php

namespace App\Http\Controllers;

use App\FirebaseCloudConnection;
use App\Http\Requests\StoreTrainingRequest;
use App\Repositories\FirebaseRepository\Interfaces\FirebaseRepositoryInterface;
use App\Repositories\TrainingRepository\Interfaces\TrainingRepositoryInterface;
use Illuminate\Http\Request;

class TrainingController extends Controller
{

    private TrainingRepositoryInterface $trainingRepository;
    private $firebaseRepository;

    public function __construct(TrainingRepositoryInterface $trainingRepository, FirebaseRepositoryInterface $firebaseRepository)
    {
        $this->trainingRepository = $trainingRepository;
        $this->firebaseRepository = $firebaseRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('training.admin.index', [
            'trainings' => $this->firebaseRepository->get(config('constants.TRAININGS.COLLECTION'), null, 'id', 'DESC')
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

        $data = $this->firebaseRepository->get(config('constants.TRAININGS.COLLECTION'), $limit, null, 'DESC', null, $whereArrayRecipe, $page, $searchKeyword);
        $totalRecords = count($this->firebaseRepository->get(config('constants.TRAININGS.COLLECTION'), null, null, 'DESC', null, $whereArrayRecipe, $page, $searchKeyword));

        return view('training.index', [
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
        return view('training.admin.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTrainingRequest $request)
    {
        unset($request['_token']);
        $storeTraining = $this->trainingRepository->store($request);
        return redirect(config('constants.TRAININGS.ADMIN_TRAININGS'))->with('success', 'Training has been created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        echo "<pre>";
        $data = $this->trainingRepository->getSingleTraining($id);
        print_r($data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $getSingleTraining = $this->trainingRepository->getSingleTraining($id);
        return view('training.admin.edit', ['training' => $getSingleTraining, 'doc_id' => $id]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreTrainingRequest $request, string $id)
    {
        unset($request['_token']);
        // Call the repository method to update the recipe
        $updated = $this->trainingRepository->updateSingleTraining($request, $id);
        // Redirect back with a message
        if ($updated) {
            return redirect(config('constants.TRAININGS.ADMIN_TRAININGS'))->with('success', 'Recipe updated successfully');
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
        $result = $this->trainingRepository->deleteSingleTraining($id);
        if ($result) {
            // The delete operation was successful
            return redirect(config('constants.TRAININGS.ADMIN_TRAININGS'))->with(config('constants.COMMON.SUCCESS'), config('constants.TRAININGS.GENERAL.DELETED'));
        } else {
            // The delete operation failed
            return redirect(config('constants.TRAININGS.ADMIN_TRAININGS'))->with(config('constants.COMMON.ERROR'), config('constants.TRAININGS.GENERAL.NOT_DELETED'));
        }
    }

    public function video(Request $request, $document_id = "")
    {
        $getSelectedDocDetail = $this->firebaseRepository->getDocumentById(config('constants.TRAININGS.COLLECTION'), (int) $document_id);

        $whereArray = [
            'category' => [
                'operator' => 'equals',
                'value' => $getSelectedDocDetail['category']
            ]
        ];
        // get category based docs
        $getCategoryBasedTrainings = $this->firebaseRepository->get(config('constants.TRAININGS.COLLECTION'), null, 'id', 'DESC', null, $whereArray);

        return view('training.video', [
            'getSelectedDocDetail' => $getSelectedDocDetail,
            'getCategoryBasedTrainings' => $getCategoryBasedTrainings
        ]);
    }


    public function categorized(Request $request)
    {
        // get category based docs
        $getTrainings = $this->firebaseRepository->get(config('constants.TRAININGS.COLLECTION'), null, 'id', 'DESC', null, '');

        // get chest
        $whereArrayChest = [
            'category' => [
                'operator' => 'equals',
                'value' => 'Chest'
            ]
        ];
        $chest = $this->firebaseRepository->get(config('constants.TRAININGS.COLLECTION'), null, 'id', 'DESC', null, $whereArrayChest);

        // get Biceps
        $whereArrayBiCeps = [
            'category' => [
                'operator' => 'equals',
                'value' => 'Biceps'
            ]
        ];
        $biCeps = $this->firebaseRepository->get(config('constants.TRAININGS.COLLECTION'), null, 'id', 'DESC', null, $whereArrayBiCeps);

        //Six Pack
        $whereArraySixPack = [
            'category' => [
                'operator' => 'equals',
                'value' => 'Six Pack'
            ]
        ];
        $sixPack = $this->firebaseRepository->get(config('constants.TRAININGS.COLLECTION'), null, 'id', 'DESC', null, $whereArraySixPack);

        //Six Pack
        $whereArrayNoEquipment = [
            'category' => [
                'operator' => 'equals',
                'value' => 'No Equipment'
            ]
        ];
        $noEquipment = $this->firebaseRepository->get(config('constants.TRAININGS.COLLECTION'), null, 'id', 'DESC', null, $whereArrayNoEquipment);

        // get firebase cloud connection got allocate signed url
        $firebaseCloudConnection = new FirebaseCloudConnection();

        return view('training.categorized', [
            'trainings' => $getTrainings,
            'chest' => $chest,
            'biCeps' => $biCeps,
            'sixPack' => $sixPack,
            'noEquipment' => $noEquipment,
            'firebaseCloudConnection' => $firebaseCloudConnection
        ]);
    }
}
