<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('activities', function (Blueprint $table) {
            // চেক করা হচ্ছে যে status কলামটি নেই
            if (!Schema::hasColumn('activities', 'status')) {
                $table->boolean('status')->default(1)->after('location');
            }
        });
    }

    public function down()
    {
        Schema::table('activities', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
