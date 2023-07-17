<?php

namespace App\Http\Controllers;

use App\Exports\MaterialsExport;
use App\Http\Requests\Element\ElementRequest;
use App\Http\Resources\Element\ElementResource;
use App\Http\Resources\Project\ProjectResource;
use App\Models\Element;
use App\Models\Project;
use Maatwebsite\Excel\Facades\Excel;

class ElementController extends Controller
{
    public function index(): \Inertia\Response|\Inertia\ResponseFactory
    {
        $elements = ElementResource::collection(\App\Models\Element::all())->resolve();
        $projects = ProjectResource::collection(Project::all())->resolve();

        return inertia('Element/Index', compact('elements', 'projects'));
    }

    public function storeElement(ElementRequest $request)
    {
        $data = $request->validated();

        $project = Project::query()->where('title', $data['project'])->get();
        $data['project_id'] = $project[0]->id;

        unset($data['project']);

        Element::query()->create($data);
    }

    public function deleteElement(Element $element)
    {
        $element->delete();
    }

    public function export(): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        return (new MaterialsExport())->download('materials.xlsx');
    }
}
