<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $columns = ['id', 'email', 'address', 'first_name', 'second_name', 'phone', 'role_id'];
        $users = User::get($columns);
        return view('users.index', ['users' => $users]);
    }

    public function create()
    {
        $roles = Role::all();
        return view('users.create', ['roles' => $roles]);
    }

    public function store(StoreUserRequest $request)
    {
        $user = User::create([
            'email' => $request->input('email'),
            'address' => $request->input('address'),
            'first_name' => $request->input('first_name'),
            'second_name' => $request->input('second_name'),
            'password' => $request->input('password'),
            'phone' => $request->input('phone'),
            'role_id' => $request->input('role_id'),
        ]);
        return redirect()->route('users.index');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $columns = ['id', 'email', 'address', 'first_name', 'second_name', 'phone', 'role_id'];
        $user = User::select($columns)->find($id);
        $roles = Role::all();
        return view('users.edit', ['user' => $user, 'roles' => $roles]);
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update($request->except('_token'));
        return redirect()->route('users.index');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index');
    }
}
