<?php

namespace App\Repositories\HomeRepository\Interfaces;

use Illuminate\Http\JsonResponse;

interface HomeRepositoryInterface
{
    public function search($keyword);
}
