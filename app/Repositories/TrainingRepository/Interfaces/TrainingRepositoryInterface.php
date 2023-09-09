<?php

namespace App\Repositories\TrainingRepository\Interfaces;

use Illuminate\Http\JsonResponse;

interface TrainingRepositoryInterface
{
    public function store($request);
    public function deleteSingleTraining($id);
    public function getSingleTraining($id);
}
