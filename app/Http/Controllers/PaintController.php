<?php

namespace App\Http\Controllers;

use App\Http\Requests\Paint\PaintStoreRequest;
use App\Http\Requests\Paint\PaintUpdateRequest;
use App\Http\Resources\Paint\PaintResource;
use App\Models\Paint;
use Inertia\Inertia;

class PaintController extends Controller
{
    public function index(): \Inertia\Response|\Inertia\ResponseFactory
    {
        $paints = PaintResource::collection(\App\Models\Paint::all()->sortBy('title'))->resolve();
        {
            return Inertia::render('Paint/Index', [
                'paints' => $paints,
            ]);
        }
    }

    public function store(PaintStoreRequest $request)
    {
        $data = $request->validated();
        Paint::query()->create($data);
    }

    public function update(PaintUpdateRequest $request, Paint $paint)
    {
        $data = $request->validated();
        $paint->update($data);
    }

    public function destroy(Paint $paint)
    {
        $paint->delete();
    }
}
