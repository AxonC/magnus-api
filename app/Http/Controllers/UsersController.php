<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::all();

        return response()->json(['data' => $users]);
    }

    public function show($id)
    {
        try {
            $id = User::findOrFail($id);
        } catch (ModelNotFoundException $exception) {
            return response()->json(['error' => 'User not found.'], 404);
        }

        return response()->json(['data' => ['user' => $id]]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name_first' => 'required|string|min:3',
            'name_last'  => 'required|string|min:3',
            'username'   => 'required|string|min:6',
            'email'      => 'required|string',
            'password'   => 'required|string|min:6',
        ]);

        $user = User::create(array_merge($request->only(['name_first', 'name_last', 'username', 'email']),
            ['password' => Hash::make($request->input('password'))]
        ));

        return response()->json(['success' => 'User created!'], 201)
            ->header('Location', route('users.show', ['id' => $user->id]));
    }

    public function update($id, Request $request)
    {
        try {
            $id = User::findOrFail($id)->update(
                $request->only(['name_first', 'name_last', 'username', 'email'])
            );
        } catch (ModelNotFoundException $exception) {
            return response()->json(['error' => 'User not found.'], 404);
        }

        return response()->json(['success' => 'User updated.']);
    }
}
