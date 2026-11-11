<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Create donation_causes table
        if (!Schema::hasTable('donation_causes')) {
            Schema::create('donation_causes', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('slug')->unique();
                $table->text('description')->nullable();
                $table->decimal('target_amount', 12, 2)->nullable();
                $table->decimal('raised_amount', 12, 2)->default(0);
                $table->string('icon')->default('fas fa-hand-holding-heart');
                $table->string('image')->nullable();
                $table->boolean('is_active')->default(true);
                $table->integer('sort_order')->default(0);
                $table->timestamps();
            });
        }

        // 2. Add extra columns to donations table
        Schema::table('donations', function (Blueprint $table) {
            if (!Schema::hasColumn('donations', 'receipt_no')) {
                $table->string('receipt_no')->nullable()->after('id');
            }
            if (!Schema::hasColumn('donations', 'is_anonymous')) {
                $table->boolean('is_anonymous')->default(false)->after('name');
            }
            if (!Schema::hasColumn('donations', 'sender_number')) {
                $table->string('sender_number')->nullable()->after('phone');
            }
            if (!Schema::hasColumn('donations', 'cause_id')) {
                $table->unsignedBigInteger('cause_id')->nullable()->after('category');
            }
            if (!Schema::hasColumn('donations', 'receipt_image')) {
                $table->string('receipt_image')->nullable()->after('transaction_id');
            }
            if (!Schema::hasColumn('donations', 'admin_notes')) {
                $table->text('admin_notes')->nullable()->after('message');
            }
            if (!Schema::hasColumn('donations', 'verified_at')) {
                $table->timestamp('verified_at')->nullable()->after('status');
            }
            if (!Schema::hasColumn('donations', 'verified_by')) {
                $table->string('verified_by')->nullable()->after('verified_at');
            }
        });

        // 3. Add payment account settings to settings table if not present
        Schema::table('settings', function (Blueprint $table) {
            if (!Schema::hasColumn('settings', 'bkash_number')) {
                $table->string('bkash_number')->nullable()->default('01765812261');
            }
            if (!Schema::hasColumn('settings', 'bkash_type')) {
                $table->string('bkash_type')->nullable()->default('মার্চেন্ট');
            }
            if (!Schema::hasColumn('settings', 'nagad_number')) {
                $table->string('nagad_number')->nullable()->default('01765812261');
            }
            if (!Schema::hasColumn('settings', 'nagad_type')) {
                $table->string('nagad_type')->nullable()->default('পার্সোনাল');
            }
            if (!Schema::hasColumn('settings', 'rocket_number')) {
                $table->string('rocket_number')->nullable()->default('017658122617');
            }
            if (!Schema::hasColumn('settings', 'bank_name')) {
                $table->string('bank_name')->nullable()->default('ইসলামী ব্যাংক বাংলাদেশ লিমিটেড');
            }
            if (!Schema::hasColumn('settings', 'bank_branch')) {
                $table->string('bank_branch')->nullable()->default('যাত্রাবাড়ী শাখা, ঢাকা');
            }
            if (!Schema::hasColumn('settings', 'bank_account_name')) {
                $table->string('bank_account_name')->nullable()->default('জমঈয়ত শুব্বানে আহলে হাদীস বাংলাদেশ');
            }
            if (!Schema::hasColumn('settings', 'bank_account_number')) {
                $table->string('bank_account_number')->nullable()->default('20501234567');
            }
            if (!Schema::hasColumn('settings', 'bank_routing')) {
                $table->string('bank_routing')->nullable()->default('125273456');
            }
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('donation_causes');
    }
};
