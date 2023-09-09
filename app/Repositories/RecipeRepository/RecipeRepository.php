<?php

namespace App\Repositories\RecipeRepository;

use App\FirebaseCloudConnection;
use App\Repositories\FirebaseRepository\Interfaces\FirebaseRepositoryInterface;
use App\Repositories\RecipeRepository\Interfaces\RecipeRepositoryInterface;
use Illuminate\Http\Request;

class RecipeRepository implements RecipeRepositoryInterface
{
    protected $firebaseCloudStorage;
    private $firebaseRepository;

    public function __construct(FirebaseCloudConnection $firebaseCloudConnection, FirebaseRepositoryInterface $firebaseRepository)
    {
        $this->firebaseCloudStorage = $firebaseCloudConnection->getFirebaseCloudStorage();
        $this->firebaseRepository = $firebaseRepository;
    }
    public function store($request)
    {
        // Get the uploaded image and video files
        $image = $request->file('image');
        $video = $request->file('video');

        // image original file name to show for end user instead of random string
        $imageOrgFilename = $image->getClientOriginalName();
        // Create a unique filename for the image and video
        $imageFilename = config('constants.RECIPES.IMAGES_PATH') . uniqid() . '.' . $image->getClientOriginalExtension();

        // video original file name to show for end user instead of random string
        $videoOrgFilename = $video->getClientOriginalName();
        // Create a unique filename for the image and video
        $videoFilename = config('constants.RECIPES.VIDEOS_PATH') . uniqid() . '.' . $video->getClientOriginalExtension();


        // Upload the file to Firebase Cloud Storage
        $this->firebaseCloudStorage->getBucket()->upload(
            fopen($image->getRealPath(), 'r'),
            ['name' => $imageFilename]
        );

        $this->firebaseCloudStorage->getBucket()->upload(
            fopen($video->getRealPath(), 'r'),
            ['name' => $videoFilename]
        );

        $this->firebaseRepository->store(config('constants.RECIPES.COLLECTION'), [
            'title' => $request->input('title'),
            'difficulty' => $request->input('difficulty'),
            'video_length' => $request->input('video_length'),
            'category' => $request->input('category'),
            'sub_category' => $request->input('sub_category'),
            'calories' => $request->input('calories'),
            'premium' => $request->input('premium'),
            'image_org_name' => $imageOrgFilename,
            'image_url' => $imageFilename,
            'video_org_name' => $videoOrgFilename,
            'video_url' => $videoFilename
        ]);
    }

    public function getSingleRecipe($id)
    {
        $data = $this->firebaseRepository->getDocument(config('constants.RECIPES.COLLECTION'), $id);
        return $data;
    }

    public function deleteSingleRecipe($id)
    {
        return $this->firebaseRepository->deleteDocumentById(config('constants.RECIPES.COLLECTION'), $id);
    }

    public function updateSingleRecipe($request, $id)
    {
        // Prepare data for update
        $data = [
            'title' => $request->input('title'),
            'difficulty' => $request->input('difficulty'),
            'video_length' => $request->input('video_length'),
            'category' => $request->input('category'),
            'sub_category' => $request->input('sub_category'),
            'calories' => $request->input('calories'),
            'premium' => $request->input('premium'),
        ];

        // Handle file uploads
        if ($request->hasFile('image')) {
            // Save the image file and add its path to the data array
            $image = $request->file('image');
            // image original file name to show for end user instead of random string
            $imageOrgFilename = $image->getClientOriginalName();
            // Create a unique filename for the image and video
            $imageFilename = config('constants.RECIPES.IMAGES_PATH') . uniqid() . '.' . $image->getClientOriginalExtension();
            // Upload the file to Firebase Cloud Storage
            $this->firebaseCloudStorage->getBucket()->upload(
                fopen($image->getRealPath(), 'r'),
                ['name' => $imageFilename]
            );
            $data['image_org_name'] = $imageOrgFilename;
            $data['image_url'] = $imageFilename;
        }

        if ($request->hasFile('video')) {
            // Save the video file and add its path to the data array
            $video = $request->file('video');
            // video original file name to show for end user instead of random string
            $videoOrgFilename = $video->getClientOriginalName();
            // Create a unique filename for the image and video
            $videoFilename = config('constants.RECIPES.VIDEOS_PATH') . uniqid() . '.' . $video->getClientOriginalExtension();
            // now move the same to cloud storage
            $this->firebaseCloudStorage->getBucket()->upload(
                fopen($video->getRealPath(), 'r'),
                ['name' => $videoFilename]
            );
            $data['video_org_name'] = $videoOrgFilename;
            $data['video_url'] = $videoFilename;

            // $data['video_url'] = $videoPath;
        }

        return $this->firebaseRepository->updateSingleDocument(config('constants.RECIPES.COLLECTION'), $id, $data);
    }
}
