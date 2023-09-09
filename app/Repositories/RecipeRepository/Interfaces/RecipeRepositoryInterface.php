<?php

namespace App\Repositories\RecipeRepository\Interfaces;

use Illuminate\Http\JsonResponse;

interface RecipeRepositoryInterface
{
    public function store($request);
    public function deleteSingleRecipe($id);
}
