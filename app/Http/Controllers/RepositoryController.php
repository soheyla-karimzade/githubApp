<?php

namespace App\Http\Controllers;

use App\Http\Resources\RepositoryResource;
use App\Models\Repository;

class RepositoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return RepositoryResource::collection(Repository::all()) ;

    }

    /**
     * Display the specified resource.
     */
    public function show(string $username)
    {
        $users = Repository::with(['user' => function ($query) {
            $query->where('username', '$username');
        }])->get();
        return RepositoryResource::collection($users) ;
    }
}
