<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EducationController extends Controller
{
    public function quran()
    {
        return view('education.quran');
    }

    public function hadith()
    {
        return view('education.hadith');
    }

    public function fiqh()
    {
        if (view()->exists('education.fiqh')) {
            return view('education.fiqh');
        }
        return view('education.islamic-studies.index');
    }

    public function arabic()
    {
        if (view()->exists('education.arabic.index')) {
            return view('education.arabic.index');
        }
        return view('education.arabic');
    }

    public function examSchedule()
    {
        // Sample exam schedule data
        $examSchedules = [
            [
                'title' => 'হিফজুল কুরআন বিভাগ',
                'date' => '২০২৫-০৩-১৫',
                'time' => 'সকাল ১০:০০',
                'venue' => 'মূল ক্যাম্পাস',
                'subjects' => ['হিফজ টেস্ট', 'তাজবীদ', 'কিরাআত']
            ],
            [
                'title' => 'হাদীস বিভাগ',
                'date' => '২০২৫-০৩-২০',
                'time' => 'সকাল ৯:০০',
                'venue' => 'মূল ক্যাম্পাস',
                'subjects' => ['হাদীস', 'উসূলে হাদীস', 'মুস্তালাহুল হাদীস']
            ],
        ];

        return view('education.exam-schedule', compact('examSchedules'));
    }

    public function results()
    {
        // Sample results data
        $results = [
            [
                'exam_name' => 'হিফজুল কুরআন ফাইনাল পরীক্ষা',
                'year' => '২০২৪',
                'published_date' => '২০২৪-১২-৩০',
                'total_students' => '১২০',
                'passed_students' => '১১০',
                'distinction' => '২৫'
            ],
            [
                'exam_name' => 'হাদীস বিভাগ সেমিস্টার ফাইনাল',
                'year' => '২০২৪',
                'published_date' => '২০২৪-১২-২৫',
                'total_students' => '৮০',
                'passed_students' => '৭৫',
                'distinction' => '১৫'
            ],
        ];

        return view('education.results', compact('results'));
    }

    public function syllabus()
    {
        // Sample syllabus data
        $syllabuses = [
            [
                'course' => 'হিফজুল কুরআন',
                'duration' => '৩ বছর',
                'subjects' => [
                    'নাজেরা',
                    'হিফজ',
                    'তাজবীদ',
                    'কিরাআত'
                ],
                'description' => 'পূর্ণাঙ্গ কুরআন হিফজ কোর্স'
            ],
            [
                'course' => 'হাদীস',
                'duration' => '২ বছর',
                'subjects' => [
                    'কুতুবে সিত্তাহ',
                    'উসূলে হাদীস',
                    'মুস্তালাহুল হাদীস',
                    'জারহ ওয়া তাদীল'
                ],
                'description' => 'হাদীস শিক্ষার পূর্ণাঙ্গ কোর্স'
            ],
        ];

        return view('education.syllabus', compact('syllabuses'));
    }
}
