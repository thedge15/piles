<?php

namespace App\Http\Controllers;

use App\Http\Requests\Element\ElementStoreRequest;
use App\Http\Requests\Element\ElementUpdateRequest;
use App\Http\Resources\Element\ElementResource;
use App\Http\Resources\Project\ProjectResource;
use App\Models\Element;
use App\Models\Project;

class ElementController extends Controller
{
    public function index(): \Inertia\Response|\Inertia\ResponseFactory
    {
        $elements = ElementResource::collection(\App\Models\Element::all()->sortBy('title'))->resolve();

        return inertia('Element/Index', compact('elements'));
    }

    public function store(ElementStoreRequest $request)
    {
        $data = $request->validated();
        Element::query()->create($data);
    }

    public function update(ElementUpdateRequest $request, Element $element)
    {
        $data = $request->validated();
        $element->update($data);
    }

    public function delete(Element $element)
    {
        $element->delete();
    }
}
