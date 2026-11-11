<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('training_registrations', function (Blueprint $table) {
            $table->id();
            $table->string('course_type');
            $table->string('name');
            $table->string('father_name');
            $table->string('mother_name');
            $table->date('date_of_birth');
            $table->string('blood_group')->nullable();
            $table->enum('gender', ['male', 'female']);
            $table->string('mobile');
            $table->string('email')->nullable();
            $table->string('emergency_contact');
            $table->string('emergency_relation');
            $table->string('present_village');
            $table->string('present_post');
            $table->string('present_thana');
            $table->string('present_district');
            $table->string('permanent_village');
            $table->string('permanent_post');
            $table->string('permanent_thana');
            $table->string('permanent_district');
            $table->string('organization_name')->nullable();
            $table->string('designation')->nullable();
            $table->date('joining_date')->nullable();
            $table->string('organization_address')->nullable();
            $table->string('photo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('training_registrations');
    }
};
