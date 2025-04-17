<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //Prikaz liste svih usera
    public function index()
    {
        $users = User::all();
        return view('admin.manage-users', compact('users'));
    }

    //Azuriranje uloge odredenog usera
    public function updateRole(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|in:admin,professor,student',
        ]);
        $user->update(['role' => $request->role]);
        return redirect()->route('users.index')->with('success', 'Role updated successfully.');
    }
}
