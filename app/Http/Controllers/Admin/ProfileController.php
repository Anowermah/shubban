<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('admin.profile');
    }

    public function update(Request $request)
    {
        $admin = Admin::find(auth()->guard('admin')->id());
        
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:admins,email,' . $admin->id],
        ]);

        $admin->name = $validated['name'];
        $admin->email = $validated['email'];
        $admin->save();

        return redirect()->route('admin.profile')
            ->with('success', 'প্রোফাইল আপডেট করা হয়েছে।');
    }

    public function password(Request $request)
    {
        $admin = Admin::find(auth()->guard('admin')->id());
        
        $validated = $request->validate([
            'current_password' => ['required', 'string'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if (!Hash::check($validated['current_password'], $admin->password)) {
            return back()->withErrors([
                'current_password' => 'বর্তমান পাসওয়ার্ড সঠিক নয়।'
            ]);
        }

        $admin->password = Hash::make($validated['password']);
        $admin->save();

        return redirect()->route('admin.profile')
            ->with('success', 'পাসওয়ার্ড পরিবর্তন করা হয়েছে।');
    }
}
