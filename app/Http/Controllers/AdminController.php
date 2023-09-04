<?php

namespace App\Http\Controllers;

use App\Http\Resources\User\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(): \Inertia\Response|\Inertia\ResponseFactory
    {
        $users = UserResource::collection(User::all())->resolve();

        return inertia('User/Users', compact('users'));
    }
}
