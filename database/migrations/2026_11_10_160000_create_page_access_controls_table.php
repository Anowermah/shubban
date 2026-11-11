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
        Schema::create('page_access_controls', function (Blueprint $table) {
            $table->id();
            $table->string('page_key')->unique();
            $table->string('page_name');
            $table->string('page_category')->default('সাধারণ');
            $table->string('route_name')->nullable();
            $table->string('route_pattern');
            $table->string('access_level')->default('public'); // public, authenticated, member_only, training_only, official_only, custom
            $table->text('allowed_roles')->nullable(); // JSON array of allowed roles
            $table->boolean('is_active')->default(true);
            $table->text('custom_message')->nullable();
            $table->timestamps();
        });

        // Add role and category to users table if not exists
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'role')) {
                $table->string('role')->default('user')->after('password');
            }
            if (!Schema::hasColumn('users', 'category')) {
                $table->string('category')->default('general')->after('role');
            }
            if (!Schema::hasColumn('users', 'status')) {
                $table->string('status')->default('active')->after('category');
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
        Schema::dropIfExists('page_access_controls');

        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'role')) {
                $table->dropColumn('role');
            }
            if (Schema::hasColumn('users', 'category')) {
                $table->dropColumn('category');
            }
            if (Schema::hasColumn('users', 'status')) {
                $table->dropColumn('status');
            }
        });
    }
};
