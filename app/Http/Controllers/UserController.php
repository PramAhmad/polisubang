<?php

namespace App\Http\Controllers;

use App\DataTables\UserDataTable;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index(UserDataTable $datatable)
    {
        $roles = Role::all();

        return $datatable->render('user.index', compact('roles'));
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|max:100',
            'email' => 'required|email|min:5|max:255|unique:users,email',
            'password' => 'required|confirmed|min:6',
            'role' =>'required'
        ]);

        $user = User::create($request->all());

        $user->assignRole($request->role);

        return response()->json(['success' => true, 'message' => 'User created successfully', '_token' => csrf_token()]);
    }

    public function edit($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['success' => false, 'message' => 'User not found'], 404);
        }

        $user->role = $user->getRoleNames()[0];

        return response()->json(['success' => true, 'data' => $user, '_token' => csrf_token()]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' =>'required|min:3|max:100',
            'email' =>'required|email|min:5|max:255|unique:users,email,'. $id,
            'password' => 'nullable|confirmed|min:6',
            'role' =>'required'
        ]);

        $user = User::find($id);

        if (!$user) {
            return response()->json(['success' => false, 'message' => 'User not found'], 404);
        }

        $update = $request->all();

        if ($request->password) {
            $request->merge(['password' => Hash::make($request->password)]);
            $update = $request->all();
        } else {
            unset($request->password);
            $update = $request->except(['password']);
        }

        $user->update($update);

        $user->syncRoles([$request->role]);

        return response()->json(['success' => true, 'message' => 'User update successfully', 'data' => $user, '_token' => csrf_token()]);
    }

    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['success' => true, 'message' => 'User not found'], 404);
        }

        $user->delete();

        return response()->json(['success' => true, 'data' => $user,'message' => 'User deleted successfully', '_token' => csrf_token()]);
    }
}
