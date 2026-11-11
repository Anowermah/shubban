<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeSection;
use Illuminate\Http\Request;

class HomepageController extends Controller
{
    /**
     * Display the Homepage Section & Layout Manager.
     */
    public function index()
    {
        HomeSection::seedDefaultsIfEmpty();
        $sections = HomeSection::orderBy('order')->get();
        return view('admin.homepage.index', compact('sections'));
    }

    /**
     * Save all section configurations and order.
     */
    public function update(Request $request)
    {
        $sectionsInput = $request->input('sections', []);

        foreach ($sectionsInput as $id => $data) {
            $section = HomeSection::find($id);
            if (!$section) {
                continue;
            }

            $isActive = isset($data['is_active']) && ($data['is_active'] == '1' || $data['is_active'] === true);
            $order = isset($data['order']) ? (int) $data['order'] : $section->order;
            $title = $data['title'] ?? null;
            $subtitle = $data['subtitle'] ?? null;
            $badgeText = $data['badge_text'] ?? null;
            $itemLimit = isset($data['item_limit']) ? max(1, (int) $data['item_limit']) : $section->item_limit;

            // Extra config handling (e.g. stats counters)
            $extra = $section->extra_config ?? [];
            if (isset($data['extra']) && is_array($data['extra'])) {
                foreach ($data['extra'] as $k => $v) {
                    $extra[$k] = $v;
                }
            }

            $section->update([
                'is_active' => $isActive,
                'order' => $order,
                'title' => $title,
                'subtitle' => $subtitle,
                'badge_text' => $badgeText,
                'item_limit' => $itemLimit,
                'extra_config' => $extra,
            ]);
        }

        return redirect()->route('admin.homepage.index')
            ->with('success', 'হোমপেজের সেকশন লেআউট ও সেটিংস সফলভাবে সংরক্ষিত হয়েছে।');
    }

    /**
     * Quick toggle single section status.
     */
    public function toggle(HomeSection $section)
    {
        $section->is_active = !$section->is_active;
        $section->save();

        if (request()->ajax() || request()->wantsJson()) {
            return response()->json([
                'success' => true,
                'is_active' => $section->is_active,
                'message' => "{$section->name_bn} সেকশনটি " . ($section->is_active ? 'সক্রিয়' : 'নিষ্ক্রিয়') . ' করা হয়েছে।',
            ]);
        }

        return redirect()->back()->with('success', "{$section->name_bn} সেকশনটি " . ($section->is_active ? 'সক্রিয়' : 'নিষ্ক্রিয়') . ' করা হয়েছে।');
    }

    /**
     * AJAX Re-order sections.
     */
    public function reorder(Request $request)
    {
        $orderList = $request->input('order', []); // array of IDs in order
        if (!empty($orderList) && is_array($orderList)) {
            foreach ($orderList as $index => $id) {
                HomeSection::where('id', $id)->update(['order' => $index + 1]);
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'সেকশনের ক্রম সফলভাবে পুনর্নির্ধারণ করা হয়েছে।',
        ]);
    }

    /**
     * Reset all homepage sections back to default factory settings.
     */
    public function reset()
    {
        HomeSection::resetToDefaults();

        return redirect()->route('admin.homepage.index')
            ->with('success', 'হোমপেজ লেআউট ও সকল সেকশন ডিফল্ট ফ্যাক্টরি সেটিংসে রিসেট করা হয়েছে।');
    }
}
