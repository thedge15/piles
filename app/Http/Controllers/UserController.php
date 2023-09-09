<?php

namespace App\Http\Controllers;

use App\Exports\PilesExport;
use App\Http\Resources\Bush\BushResource;
use App\Http\Resources\Material\MaterialResource;
use App\Http\Resources\Project\ProjectResource;
use App\Models\Bush;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    public function welcome(): \Inertia\Response|\Inertia\ResponseFactory
    {
        return inertia('Welcome');
    }
    public function openPage(): \Inertia\Response|\Inertia\ResponseFactory
    {
        $bushes = BushResource::collection(Bush::all()->sortBy('title'))->resolve();
        return inertia('OpenPage', compact('bushes'));
    }

    public function index(Bush $bush): \Inertia\Response|\Inertia\ResponseFactory
    {
        $projects = ProjectResource::collection($bush->projects)->resolve();
        $bush = new BushResource($bush);
        return inertia('User/Index', compact('projects', 'bush'));
    }
}
