<?php

namespace App\Repositories\TestRepository;

use App\Repositories\TestRepository\Interfaces\TestRepositoryInterface;

class TestRepository implements TestRepositoryInterface
{
    public function showTest()
    {
        echo "Repository is fun";
    }
}
