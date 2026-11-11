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
        if (!Schema::hasColumn('members', 'status')) {
            Schema::table('members', function (Blueprint $table) {
                $table->boolean('status')->default(true);
            });
        }
        
        if (!Schema::hasColumn('news', 'status')) {
            Schema::table('news', function (Blueprint $table) {
                $table->boolean('status')->default(true);
            });
        }
        
        if (!Schema::hasColumn('contacts', 'status')) {
            Schema::table('contacts', function (Blueprint $table) {
                $table->boolean('status')->default(false);
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('members', function (Blueprint $table) {
            $table->dropColumn('status');
        });
        
        Schema::table('news', function (Blueprint $table) {
            $table->dropColumn('status');
        });
        
        Schema::table('contacts', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }

};
