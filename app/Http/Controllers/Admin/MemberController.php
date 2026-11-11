<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Member;

class MemberController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $members = Member::latest()
            ->when($search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%")
                    ->orWhere('address', 'like', "%{$search}%");
            })
            ->paginate(10);

        return view('admin.members.index', compact('members', 'search'));
    }

    public function create()
    {
        return view('admin.members.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:members',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
            'status' => 'boolean'
        ]);

        Member::create($validated);
        return redirect()->route('admin.members.index')->with('success', 'সদস্য যোগ করা হয়েছে।');
    }

    public function show(Member $member)
    {
        return view('admin.members.show', compact('member'));
    }

    public function edit(Member $member)
    {
        return view('admin.members.edit', compact('member'));
    }

    public function update(Request $request, Member $member)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:members,email,' . $member->id,
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
            'status' => 'boolean'
        ]);

        $member->update($validated);
        return redirect()->route('admin.members.index')->with('success', 'সদস্য আপডেট করা হয়েছে।');
    }

    public function destroy(Member $member)
    {
        $member->delete();
        return redirect()->route('admin.members.index')->with('success', 'সদস্য মুছে ফেলা হয়েছে।');
    }
}
