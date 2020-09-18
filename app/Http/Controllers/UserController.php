<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->has('search')) {
            $query->where('name', 'like', "%{$request->get('search')}%")
                ->orWhere('email', 'like', "%{$request->get('search')}%");
        }

        $query->latest();

        return view('user.index', ['users' => $query->simplePaginate(10)]);
    }

    public function create()
    {
        return view('user.create');
    }

    public function edit(User $user)
    {
        return view('user.edit', ['user' => $user]);
    }

    public function update(User $user, Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'confirmed',
        ]);

        $user->name = $request->input('name');
        $user->email = $request->input('email');

        if ($request->get('password')) {
            $user->password = $request->input('password');
        }

        $user->save();

        return redirect()->back();
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required|confirmed',
        ]);

        User::create($request->only('name', 'email', 'password'));

        return redirect()->to('/user');
    }

    public function delete(User $user)
    {
        $user->delete();

        return redirect('/user');
    }
}
