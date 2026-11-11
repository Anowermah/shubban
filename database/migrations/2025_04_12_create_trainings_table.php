<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('trainings', function (Blueprint $table) {
            $table->id();
            $table->json('title');
            $table->json('description');
            $table->datetime('start_date');
            $table->datetime('end_date');
            $table->json('location');
            $table->enum('type', ['aref', 'rageb', 'salek', 'saleh']);
            $table->string('organization_name')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('trainings');
    }
};
