<?php

namespace App\Http\Controllers;

use App\Http\Requests\Tube\TubeStoreRequest;
use App\Http\Resources\Tube\TubeResource;
use App\Models\Tube;

class TubeController extends Controller
{
    public function index(): \Inertia\Response|\Inertia\ResponseFactory
    {
        $tubes = TubeResource::collection(Tube::all());
        return inertia('Tube/Index', compact('tubes'));
    }


    public function store(TubeStoreRequest $request)
    {

        $data = $request->validated();

        $title = 'ТРУБА ' . $data['diameter'] . 'Х' . $data['wall_thickness'];
        $data['title'] = $title;

        Tube::query()->create($data);
    }

    public function show(Tube $tube)
    {

    }

    public function destroy(Tube $tube)
    {
        $tube->delete();
    }
}
