<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::paginate(16)->fragment(hash('crc32', 'users'));

        $roles = Role::all();

        return view('panel.users.index', [
            'users' => $users,
            'roles' => $roles
        ]);
    }

    public function store(Request $request)
    {

        try {

            $request->validate([
                'name' => 'required|string',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:8|confirmed',
                'password_confirmation' => 'required|same:password',
                'role' => 'required',
                'phone' => 'string|nullable|min: 11|max:14',
                'status' => 'required|in:0,1',
                'profile_image' => 'nullable|image|max:2048',
            ]);

            $user = new User();

            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->status = $request->status;
            $user->phone = $request->phone;

            if ($request->hasFile('profile_image')) {
                $file = $request->file('profile_image');
                $file_name = time() . Str::random(16) . '.' . Str::replace(' ', '-', $file->getClientOriginalExtension());
                Storage::disk('public')->putFileAs('users', $file, $file_name);
                $user->profile_image = $file_name;
            } else {
                $user->profile_image = null;
            }

            $user->save();

            // assign role to user
            $user->assignRole($request->role);

            return back()->with('success', 'User created successfully');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }


    public function destroy(Request $request)
    {
        $user = User::find($request->id);
        if ($user) {
            // delete files
            if ($user->profile_image) {
                Storage::disk('public')->delete('users/' . $user->profile_image);
            }

            // delete associated roles
            $user->roles()->detach();

            // delete user
            $user->delete();
            
            return back()->with('success', 'User deleted successfully');
        } else {
            return back()->with('error', 'User not found');
        }
    }
}
