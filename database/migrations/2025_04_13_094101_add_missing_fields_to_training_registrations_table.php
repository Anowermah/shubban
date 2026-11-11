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
        Schema::table('training_registrations', function (Blueprint $table) {
            // Drop old fields
            $table->dropColumn(['organization_name', 'joining_date', 'organization_address']);
            
            // Add new fields
            $table->string('last_education');
            $table->string('institute');
            $table->year('passing_year');
            $table->string('result');
            $table->string('father_occupation')->nullable();
            $table->string('nid')->nullable();
            $table->string('pdf_path')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('training_registrations', function (Blueprint $table) {
            // Drop new fields
            $table->dropColumn([
                'last_education',
                'institute',
                'passing_year',
                'result',
                'father_occupation',
                'nid',
                'pdf_path'
            ]);
            
            // Add back old fields
            $table->string('organization_name')->nullable();
            $table->date('joining_date')->nullable();
            $table->string('organization_address')->nullable();
        });
    }
};
