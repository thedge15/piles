<?php

namespace App\Http\Controllers;

use App\Exports\PilesExport;
use App\Http\Resources\Bush\BushResource;
use App\Http\Resources\Pile\PileResource;
use App\Http\Resources\Project\ProjectResource;
use App\Http\Resources\Tube\TubeResource;
use App\Models\Bush;
use App\Models\Material;
use App\Models\Pile;
use App\Models\Project;
use App\Models\Tube;

use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Exception;

class UserController extends Controller
{
    public function dashboard(): \Inertia\Response|\Inertia\ResponseFactory
    {
        $bushes = BushResource::collection(Bush::all())->resolve();

        return inertia('Dashboard', compact('bushes'));
    }

//    public function piles(): \Inertia\Response|\Inertia\ResponseFactory
//    {
//        $piles = PileResource::collection(Pile::all());
//        return inertia('User/Piles', compact('piles'));
//    }

    public function index(Bush $bush): \Inertia\Response|\Inertia\ResponseFactory
    {
        $projects = ProjectResource::collection($bush->projects)->resolve();
        $bush = new BushResource($bush);
        return inertia('User/Index', compact('projects', 'bush'));
    }

//    public function show(Project $project): \Inertia\Response|\Inertia\ResponseFactory
//    {
//        $concreteQuantity = 0;
//        $piles = PileResource::collection($project->piles);
//        $project = new ProjectResource($project);
//        $tubes = TubeResource::collection(Tube::all());
//        return inertia('User/Show', compact('piles', ['project', 'tubes', 'concreteQuantity']));
//    }

    public function export(): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        return Excel::download(new PilesExport,  'piles.xlsx');
    }
}
