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
        Schema::create('archives', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->integer('year');
            $table->string('cover_image');
            $table->boolean('status')->default(true);
            $table->timestamps();
        });

        // Add archive_id to photos table
        Schema::table('photos', function (Blueprint $table) {
            $table->foreignId('archive_id')->nullable()->constrained()->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('photos', function (Blueprint $table) {
            $table->dropForeign(['archive_id']);
            $table->dropColumn('archive_id');
        });
        
        Schema::dropIfExists('archives');
    }
};
