<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('news', function (Blueprint $table) {
            // Drop content column if exists
            if (Schema::hasColumn('news', 'content')) {
                $table->dropColumn('content');
            }
            
            // Add description column
            $table->text('description');
            
            // Drop date column if exists
            if (Schema::hasColumn('news', 'date')) {
                $table->dropColumn('date');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('news', function (Blueprint $table) {
            // Revert changes
            $table->dropColumn('description');
            $table->text('content');
            $table->date('date');
        });
    }
};
