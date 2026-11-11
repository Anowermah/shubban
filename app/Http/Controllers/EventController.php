<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function conferences()
    {
        return view('events.conferences');
    }

    public function seminars()
    {
        return view('events.seminars');
    }

    public function workshops()
    {
        return view('events.workshops');
    }

    public function upcoming()
    {
        $events = Event::where('start_date', '>=', Carbon::now())
            ->where('status', true)
            ->orderBy('start_date', 'asc')
            ->paginate(9);

        return view('events.upcoming', compact('events'));
    }

    public function past()
    {
        $events = Event::where('start_date', '<', Carbon::now())
            ->where('status', true)
            ->orderBy('start_date', 'desc')
            ->paginate(9);

        return view('events.past', compact('events'));
    }

    public function annual()
    {
        $events = Event::where('is_annual', true)
            ->where('status', true)
            ->orderBy('start_date', 'asc')
            ->get();

        return view('events.annual', compact('events'));
    }

    public function show(Event $event)
    {
        if (!$event->status) {
            abort(404);
        }

        return view('events.show', compact('event'));
    }

    public function register(Event $event)
    {
        if (!$event->status || !$event->registration_required) {
            abort(404);
        }

        // TODO: Implement registration logic
        return view('events.register', compact('event'));
    }

    public function showOld($id)
    {
        // Sample event data - in a real application, this would come from a database
        $events = [
            1 => [
                'id' => 1,
                'title' => 'কুরআন শিক্ষা সম্মেলন ২০২৫',
                'type' => 'conference',
                'date' => '২০২৫-০৩-১৫',
                'time' => 'সকাল ১০:০০',
                'venue' => 'প্রধান মিলনায়তন',
                'description' => 'কুরআন শিক্ষার উন্নয়নে আধুনিক পদ্ধতি ও প্রযুক্তির ব্যবহার নিয়ে আলোচনা',
                'speakers' => [
                    ['name' => 'মাওলানা আব্দুল করিম', 'designation' => 'প্রধান শিক্ষক, দারুল উলূম'],
                    ['name' => 'ড. মুহাম্মদ আহমেদ', 'designation' => 'অধ্যাপক, ইসলামিক স্টাডিজ']
                ],
                'schedule' => [
                    ['time' => '১০:০০', 'session' => 'উদ্বোধনী অনুষ্ঠান'],
                    ['time' => '১১:০০', 'session' => 'প্রথম সেশন: আধুনিক শিক্ষা পদ্ধতি'],
                    ['time' => '১৪:০০', 'session' => 'দ্বিতীয় সেশন: প্রযুক্তির ব্যবহার'],
                    ['time' => '১৬:০০', 'session' => 'সমাপনী অনুষ্ঠান']
                ]
            ],
            2 => [
                'id' => 2,
                'title' => 'ইসলামিক সেমিনার ২০২৫',
                'type' => 'seminar',
                'date' => '২০২৫-০৩-২০',
                'time' => 'সকাল ০৯:০০',
                'venue' => 'সেমিনার হল',
                'description' => 'ইসলামিক জ্ঞান ও গবেষণার বিভিন্ন দিক নিয়ে আলোচনা',
                'speakers' => [
                    ['name' => 'প্রফেসর ড. রফিক আহমেদ', 'designation' => 'বিভাগীয় প্রধান, ইসলামিক স্টাডিজ'],
                    ['name' => 'মাওলানা হাবিবুর রহমান', 'designation' => 'গবেষক, ইসলামিক ফাউন্ডেশন']
                ],
                'schedule' => [
                    ['time' => '০৯:০০', 'session' => 'রেজিস্ট্রেশন'],
                    ['time' => '০৯:৩০', 'session' => 'কুরআন তেলাওয়াত'],
                    ['time' => '১০:০০', 'session' => 'মূল আলোচনা'],
                    ['time' => '১৩:০০', 'session' => 'প্রশ্নোত্তর পর্ব']
                ]
            ],
            3 => [
                'id' => 3,
                'title' => 'ইসলামিক ক্যালিগ্রাফি ওয়ার্কশপ',
                'type' => 'workshop',
                'date' => '২০২৫-০৩-২৫',
                'time' => 'সকাল ১১:০০',
                'venue' => 'আর্ট স্টুডিও',
                'description' => 'ইসলামিক ক্যালিগ্রাফির বিভিন্ন স্টাইল ও টেকনিক শেখানো হবে',
                'instructor' => 'উস্তাদ আব্দুল্লাহ আল-খত্তাত',
                'materials' => [
                    'ক্যালিগ্রাফি কলম',
                    'স্পেশাল পেপার',
                    'ইংক',
                    'প্র্যাকটিস শীট'
                ],
                'schedule' => [
                    ['time' => '১১:০০', 'session' => 'বেসিক টেকনিক'],
                    ['time' => '১৩:০০', 'session' => 'নাস্তালিক স্টাইল'],
                    ['time' => '১৫:০০', 'session' => 'দিওয়ানি স্টাইল'],
                    ['time' => '১৬:০০', 'session' => 'প্র্যাকটিকাল সেশন']
                ]
            ]
        ];

        // Find the event by ID
        if (!isset($events[$id])) {
            abort(404, 'Event not found');
        }

        $event = $events[$id];
        
        return view('events.show', compact('event'));
    }
}
