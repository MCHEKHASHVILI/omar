<?php

namespace App\Http\Controllers;

use App\Repositories\TestRepository\Interfaces\TestRepositoryInterface;
use Illuminate\Http\Request;

class TestController extends Controller
{
    private TestRepositoryInterface $testRepository;

    public function __construct(TestRepositoryInterface $testRepository)
    {
        $this->testRepository = $testRepository;
    }
    public function index()
    {
        $this->testRepository->showTest();
    }
}
