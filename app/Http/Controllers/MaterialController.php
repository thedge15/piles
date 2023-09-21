<?php

namespace App\Http\Controllers;

use App\Actions\IndexProjectsAction;
use App\Actions\Material\IndexMaterialsAction;
use App\Actions\Material\StoreMaterialAction;
use App\Actions\Material\UpdateMaterialAction;
use App\Actions\ShowAllAction;
use App\Exports\MaterialsExport;
use App\Models\Material;
use App\Models\Project;
use Maatwebsite\Excel\Facades\Excel;


class MaterialController extends Controller
{
//    public function index(Bush $bush, IndexProjectsAction $action): \Inertia\Response|\Inertia\ResponseFactory
//    {
//        return inertia('User/Index', $action->handle($bush));
//    }

    public function index(Project $project, IndexMaterialsAction $action): \Inertia\Response|\Inertia\ResponseFactory
    {
        return inertia('Material/Index', $action->handle($project));
    }
    public function store(StoreMaterialAction $action)
    {
        Material::query()->create($action->handle());
    }
    public function update(UpdateMaterialAction $action, Material $material)
    {
        $material->update($action->handle());
    }
    public function destroy(Material $material)
    {
        $material->delete();
    }
    public function showAll(ShowAllAction $action): \Inertia\Response|\Inertia\ResponseFactory
    {
        return inertia('Material/All', $action->handle());
    }

    public function export(Project $project): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        return Excel::download(new MaterialsExport($project), 'materials.xlsx');
    }
}

