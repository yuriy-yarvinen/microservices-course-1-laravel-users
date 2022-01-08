<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\PaginatedResource;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{

    public function index()
    {
        return PaginatedResource::collection(User::paginate());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);

        $data['password'] = Hash::make($data['password']);

        $user = User::create($data);

        return response($user, Response::HTTP_CREATED);
    }

    public function customUsers(Request $request)
    {
        $data = $request->validate([
            'is_influencer' => 'required',
        ]);
        
        return User::where($data)->get();
    }


    public function show($id)
    {
        return User::find($id);
    }


    public function update(Request $request, $id)
    {
        $user = User::find($id);

        $user->update($request->only(['first_name', 'last_name', 'email']));

        return response($user, Response::HTTP_ACCEPTED);
    }

    public function destroy($id)
    {
        User::destroy($id);

        return response(null, Response::HTTP_NO_CONTENT);

    }
}
