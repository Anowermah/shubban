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
        Schema::table('activities', function (Blueprint $table) {
            // Remove old columns
            $table->dropColumn(['date', 'time', 'location']);
            
            // Add image column
            $table->string('image')->after('description');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('activities', function (Blueprint $table) {
            // Add back old columns
            $table->date('date');
            $table->time('time')->nullable();
            $table->string('location')->nullable();
            
            // Remove image column
            $table->dropColumn('image');
        });
    }
};
