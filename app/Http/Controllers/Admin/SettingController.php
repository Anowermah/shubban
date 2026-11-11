<?php

namespace App\Http\Controllers\Admin;

class SettingController extends Controller
{
    public function edit()
    {
        return view('admin.settings.edit');
    }

    public function update()
    {
        // Add validation and update logic here
        return redirect()->route('admin.settings')->with('success', 'সেটিংস আপডেট করা হয়েছে।');
    }
}
