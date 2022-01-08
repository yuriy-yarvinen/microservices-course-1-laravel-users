<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\PaginatedResource;

class UserController extends Controller
{

    public function index()
    {
        return PaginatedResource::collection(User::paginate());
    }

    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        return User::find($id);
    }


    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
