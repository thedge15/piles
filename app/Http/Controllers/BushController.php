<?php

namespace App\Http\Controllers;

use App\Actions\Bush\BushIndexAction;
use App\Actions\Bush\BushShowAction;
use App\Actions\Bush\BushStoreAction;
use App\Models\Bush;
use Inertia\Response;
use Inertia\ResponseFactory;

class BushController extends Controller
{
    /**
     * @param BushIndexAction $action
     * @return Response|ResponseFactory
     */
    public function index(BushIndexAction $action): Response|ResponseFactory
    {
        return inertia('Bush/Index', $action->handle());
    }

    /**
     * @param BushStoreAction $action
     * @return void
     */
    public function store(BushStoreAction $action): void
    {
        Bush::query()->create($action->handle());
    }

    /**
     * @param Bush $bush
     * @param BushShowAction $action
     * @return Response|ResponseFactory
     */
    public function show(Bush $bush, BushShowAction $action): Response|ResponseFactory
    {
        return inertia('Bush/Show', $action->handle($bush));
    }

    /**
     * @param Bush $bush
     * @return void
     */
    public function destroy(Bush $bush): void
    {
        collect($bush->projects)->each(function ($item) {
            $this->destroy($item);
        });
        $bush->delete();
    }
}
