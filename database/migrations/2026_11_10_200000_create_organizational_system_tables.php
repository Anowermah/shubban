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
        // Add organizational worker fields to users table
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'worker_tier')) {
                $table->string('worker_tier')->default('general')->after('role'); // general, rageb, aref, salek, saleh
            }
            if (!Schema::hasColumn('users', 'org_tier')) {
                $table->string('org_tier')->default('branch')->after('worker_tier'); // branch, upazila, district, central
            }
            if (!Schema::hasColumn('users', 'designation')) {
                $table->string('designation')->default('সাধারণ কর্মী')->after('org_tier');
            }
            if (!Schema::hasColumn('users', 'branch_name')) {
                $table->string('branch_name')->nullable()->after('designation');
            }
            if (!Schema::hasColumn('users', 'phone')) {
                $table->string('phone')->nullable()->after('branch_name');
            }
            if (!Schema::hasColumn('users', 'blood_group')) {
                $table->string('blood_group')->nullable()->after('phone');
            }
            if (!Schema::hasColumn('users', 'profession')) {
                $table->string('profession')->nullable()->after('blood_group');
            }
            if (!Schema::hasColumn('users', 'address')) {
                $table->text('address')->nullable()->after('profession');
            }
            if (!Schema::hasColumn('users', 'monthly_iyanat')) {
                $table->decimal('monthly_iyanat', 10, 2)->default(200.00)->after('address');
            }
            if (!Schema::hasColumn('users', 'tier_promoted_at')) {
                $table->timestamp('tier_promoted_at')->nullable()->after('monthly_iyanat');
            }
        });

        // Monthly Iyanat (মাসিক সাংগঠনিক চাঁদা / এয়ানত)
        Schema::create('iyanats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('receipt_no')->unique();
            $table->string('month'); // e.g. "জানুয়ারি ২০২৬"
            $table->decimal('amount', 10, 2);
            $table->string('payment_method')->default('bkash'); // bkash, nagad, rocket, bank, cash
            $table->string('transaction_id')->nullable();
            $table->string('phone')->nullable();
            $table->string('status')->default('pending'); // pending, approved, rejected
            $table->text('note')->nullable();
            $table->timestamps();
        });

        // Program Reports (শাখা ও কর্মীদের কর্মসূচি প্রতিবেদন)
        Schema::create('program_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('org_tier')->default('branch'); // branch, upazila, district, central
            $table->string('branch_name')->nullable();
            $table->string('program_type'); // মাসিক সাধারণ সভা, তাফসীর মাহফিল, যুব সমাবেশ, পাঠচক্র, দাওয়াতী সফর ইত্যাদি
            $table->string('title');
            $table->date('date');
            $table->string('venue')->nullable();
            $table->integer('worker_attendance')->default(0);
            $table->integer('guest_attendance')->default(0);
            $table->longText('description');
            $table->string('attachment')->nullable();
            $table->string('status')->default('submitted'); // submitted, under_review, approved
            $table->text('admin_feedback')->nullable();
            $table->timestamps();
        });

        // Tier Promotion Applications (মানোন্নয়ন ও স্তর পরিবর্তন আবেদন)
        Schema::create('tier_promotions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('current_tier');
            $table->string('target_tier');
            $table->boolean('syllabus_completed')->default(false);
            $table->text('books_read')->nullable();
            $table->text('applicant_notes')->nullable();
            $table->string('status')->default('pending'); // pending, approved, rejected
            $table->text('admin_notes')->nullable();
            $table->timestamps();
        });

        // Syllabus Reading Progress Checklist (সিলেবাস ও কিতাব পাঠ অগ্রগতি)
        Schema::create('user_syllabus_progress', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('tier'); // rageb, aref, salek, saleh
            $table->string('item_key'); // unique key for syllabus item / book
            $table->boolean('is_completed')->default(false);
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();

            $table->unique(['user_id', 'tier', 'item_key']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_syllabus_progress');
        Schema::dropIfExists('tier_promotions');
        Schema::dropIfExists('program_reports');
        Schema::dropIfExists('iyanats');

        Schema::table('users', function (Blueprint $table) {
            $cols = ['worker_tier', 'org_tier', 'designation', 'branch_name', 'phone', 'blood_group', 'profession', 'address', 'monthly_iyanat', 'tier_promoted_at'];
            foreach ($cols as $col) {
                if (Schema::hasColumn('users', $col)) {
                    $table->dropColumn($col);
                }
            }
        });
    }
};
