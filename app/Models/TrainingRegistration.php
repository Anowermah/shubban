<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\CourseType;

class TrainingRegistration extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_type',
        'name',
        'father_name',
        'mother_name',
        'date_of_birth',
        'blood_group',
        'gender',
        'mobile',
        'email',
        'emergency_contact',
        'emergency_relation',
        'nid',
        'father_occupation',
        'photo',
        'present_village',
        'present_post',
        'present_thana',
        'present_district',
        'permanent_village',
        'permanent_post',
        'permanent_thana',
        'permanent_district',
        'last_education',
        'institute',
        'passing_year',
        'result',
        'organization_name',
        'designation',
        'joining_date',
        'organization_address',
        'pdf_path'
    ];

    protected $casts = [
        'course_type' => CourseType::class,
        'date_of_birth' => 'date',
        'joining_date' => 'date'
    ];
}
