<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EventsController extends Controller
{
    public function annual()
    {
        $annualEvents = [
            [
                'title' => 'ঈদুল ফিতর',
                'description' => 'রমজান মাসের শেষে ঈদুল ফিতর উদযাপন',
                'date' => 'শাওয়াল মাসের ১ তারিখ',
                'icon' => 'fas fa-moon',
            ],
            [
                'title' => 'ঈদুল আযহা',
                'description' => 'কুরবানির ঈদ উদযাপন',
                'date' => 'যিলহজ্জ মাসের ১০ তারিখ',
                'icon' => 'fas fa-sheep',
            ],
            [
                'title' => 'শবে বরাত',
                'description' => 'পবিত্র শবে বরাত উদযাপন',
                'date' => 'শাবান মাসের ১৫ তারিখ',
                'icon' => 'fas fa-star-and-crescent',
            ],
            [
                'title' => 'শবে কদর',
                'description' => 'পবিত্র শবে কদর উদযাপন',
                'date' => 'রমজান মাসের শেষ দশক',
                'icon' => 'fas fa-moon-stars',
            ],
            [
                'title' => 'বার্ষিক মাহফিল',
                'description' => 'বার্ষিক ইসলামী মাহফিল',
                'date' => 'প্রতি বছর রবিউল আউয়াল মাসে',
                'icon' => 'fas fa-microphone-alt',
            ],
            [
                'title' => 'কুরআন প্রতিযোগিতা',
                'description' => 'বার্ষিক কুরআন তিলাওয়াত ও হিফজ প্রতিযোগিতা',
                'date' => 'প্রতি বছর জমাদিউল আউয়াল মাসে',
                'icon' => 'fas fa-book-quran',
            ],
            [
                'title' => 'ইসলামী সেমিনার',
                'description' => 'বার্ষিক ইসলামী জ্ঞান বিষয়ক সেমিনার',
                'date' => 'প্রতি বছর রজব মাসে',
                'icon' => 'fas fa-chalkboard-teacher',
            ],
            [
                'title' => 'দাওয়াহ কনফারেন্স',
                'description' => 'বার্ষিক দাওয়াহ ও তাবলীগ কনফারেন্স',
                'date' => 'প্রতি বছর সফর মাসে',
                'icon' => 'fas fa-hands-helping',
            ]
        ];

        return view('events.annual', compact('annualEvents'));
    }

    public function upcoming()
    {
        return view('events.upcoming');
    }

    public function past()
    {
        return view('events.past');
    }
}
