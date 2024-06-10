<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public function index()
    {
        $row = (int) request('row', 10);

        // Validate the 'row' parameter
        if ($row < 1 || $row > 100) {
            abort(400, 'The per-page parameter must be an integer between 1 and 100.');
        }

        $users = User::query()
            ->when(request('search'), function ($query) {
                $query->where('name', 'like', '%' . request('search') . '%')
                      ->orWhere('email', 'like', '%' . request('search') . '%')
                      ->orWhere('username', 'like', '%' . request('search') . '%');
            })
            ->sortable()
            ->paginate($row)
            ->appends(request()->query());

        return response()->json($users);
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|max:50',
            'photo' => 'image|file|max:1024',
            'email' => 'required|email|max:50|unique:users,email',
            'username' => 'required|min:4|max:25|alpha_dash:ascii|unique:users,username',
            'password' => 'min:6|required_with:password_confirmation',
            'password_confirmation' => 'min:6|same:password',
        ];

        $validatedData = $request->validate($rules);
        $validatedData['password'] = Hash::make($request->password);

        /**
         * Handle upload image with Storage.
         */
        if ($file = $request->file('photo')) {
            $fileName = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
            $path = 'public/profile/';

            $file->storeAs($path, $fileName);
            $validatedData['photo'] = $fileName;
        }

        $user = User::create($validatedData);

        if($request->role) {
            $user->assignRole($request->role);
        }

        return response()->json(['message' => 'Customer has been created!']);

    }
    public function update(Request $request, $id)
    {
        $rules = [
            'name' => 'required|string|max:50',
            'email' => 'required|email|max:50|unique:users,email,' . $id,
            'username' => 'required|string|min:4|max:25|alpha_dash|unique:users,username,' . $id,
            'password' => 'nullable|min:6|confirmed',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];

        $validatedData = $request->validate($rules);
        $user = User::findOrFail($id);

        // Handle photo upload
        if ($file = $request->file('photo')) {
            if ($user->photo) {
                Storage::delete('public/profile/' . $user->photo);
            }
            $fileName = hexdec(uniqid()) . '.' . $file->getClientOriginalExtension();
            $path = 'public/profile/';
            $file->storeAs($path, $fileName);
            $validatedData['photo'] = $fileName;
        }

        // Handle password update
        if (!empty($validatedData['password'])) {
            $validatedData['password'] = Hash::make($validatedData['password']);
        } else {
            unset($validatedData['password']);
        }

        $user->update($validatedData);
        return response()->json(['message' => 'User has been edited!']);
    }

    public function destroy($userId)
    {
        $user = User::find($userId);

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        // Remove the user's roles
        // $user->syncRoles([]);

        // Check if the user has a photo and delete it from storage
        if ($user->photo) {
            Storage::delete('public/profile/' . $user->photo);
        }

        // Delete the user
        $user->delete();

        return response()->json(['message' => 'User deleted successfully'], 200);
    }

}
