<?php

namespace App\Http\Controllers;

use App\Http\Requests\Paint\PaintStoreRequest;
use App\Http\Resources\Paint\PaintResource;
use App\Models\Paint;
use Illuminate\Http\Request;

class PaintController extends Controller
{
    public function index(): \Inertia\Response|\Inertia\ResponseFactory
    {
        $paints = PaintResource::collection(\App\Models\Paint::all())->resolve();
        return inertia('Paint/Index', compact('paints'));
    }

    public function store(PaintStoreRequest $request)
    {
        $data = $request->validated();
        Paint::query()->create($data);
    }

    public function destroy(Paint $paint)
    {
        $paint->delete();
    }
}
