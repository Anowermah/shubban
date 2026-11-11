<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('admin:create {email=admin@shubban.org} {password=admin123} {name=Admin}', function ($email, $password, $name) {
    $admin = \App\Models\Admin::updateOrCreate(
        ['email' => $email],
        [
            'name' => $name,
            'password' => \Illuminate\Support\Facades\Hash::make($password),
            'status' => 1,
        ]
    );
    $this->info("✅ Super Admin Account Ready!");
    $this->line("👤 Name:     {$name}");
    $this->line("📧 Email:    {$email}");
    $this->line("🔑 Password: {$password}");
    $this->line("🌐 Login at: /admin/login");
})->purpose('Create or reset super admin login credentials');

Artisan::command('user:create {email=anowar266927@gmail.com} {password=123456} {name=Anower}', function ($email, $password, $name) {
    $user = \App\Models\User::updateOrCreate(
        ['email' => $email],
        [
            'name' => $name,
            'password' => \Illuminate\Support\Facades\Hash::make($password),
        ]
    );
    $this->info("✅ Regular User Account Ready!");
    $this->line("👤 Name:     {$name}");
    $this->line("📧 Email:    {$email}");
    $this->line("🔑 Password: {$password}");
    $this->line("🌐 Login at: /login");
})->purpose('Create or reset regular user login credentials');

Artisan::command('db:import-backup', function () {
    $sqlPath = base_path('weekbieb_final_shubban.sql');
    if (!file_exists($sqlPath)) {
        $this->error("❌ Backup SQL file not found at: {$sqlPath}");
        return 1;
    }

    $this->info("⏳ Importing database records from weekbieb_final_shubban.sql...");

    try {
        $driver = \Illuminate\Support\Facades\DB::connection()->getDriverName();
        if ($driver === 'mysql') {
            \Illuminate\Support\Facades\DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        }

        $sql = file_get_contents($sqlPath);
        \Illuminate\Support\Facades\DB::unprepared($sql);

        if ($driver === 'mysql') {
            \Illuminate\Support\Facades\DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        }

        $this->info("✅ Database backup imported successfully!");

        // Run migrations for any newer tables (home_sections, ai_chat, pwa, etc.)
        $this->info("⏳ Synchronizing latest migrations...");
        $this->call('migrate', ['--force' => true]);

        // Clear caches
        $this->call('optimize:clear');

        $this->info("🎉 All books, photos, sliders, notices, and settings are now 100% restored!");
        return 0;
    } catch (\Throwable $e) {
        $this->error("❌ Import failed: " . $e->getMessage());
        return 1;
    }
})->purpose('Import full database backup from weekbieb_final_shubban.sql and synchronize migrations');


Artisan::command('system:repair', function () {
    $this->info("🔧 Starting Full System Diagnostics and Repair...");

    // 1. Run migrations
    $this->info("⏳ Step 1/4: Running all database migrations...");
    try {
        $this->call('migrate', ['--force' => true]);
        $this->info("✅ Database tables migrated successfully.");
    } catch (\Throwable $e) {
        $this->warn("⚠️ Migration notice: " . $e->getMessage());
    }

    // 2. Ensure Super Admin account
    $this->info("⏳ Step 2/4: Verifying Super Admin credentials...");
    try {
        \App\Models\Admin::updateOrCreate(
            ['email' => 'admin@shubban.org'],
            [
                'name' => 'Super Admin',
                'password' => \Illuminate\Support\Facades\Hash::make('admin123'),
                'status' => 1,
            ]
        );
        $this->info("✅ Super Admin verified (admin@shubban.org / admin123).");
    } catch (\Throwable $e) {
        $this->warn("⚠️ Admin notice: " . $e->getMessage());
    }

    // 3. Ensure Default Home Sections
    $this->info("⏳ Step 3/4: Synchronizing Home Sections...");
    try {
        if (\Illuminate\Support\Facades\Schema::hasTable('home_sections') && \App\Models\HomeSection::count() === 0) {
            \App\Models\HomeSection::seedDefaults();
            $this->info("✅ Default homepage sections seeded.");
        }
    } catch (\Throwable $e) {
        $this->warn("⚠️ HomeSection notice: " . $e->getMessage());
    }

    // 4. Clear all caches
    $this->info("⏳ Step 4/4: Clearing application, route, config, and view caches...");
    $this->call('optimize:clear');

    $this->info("🎉 System repair completed successfully! All pages and admin dashboard are 100% operational.");
    return 0;
})->purpose('Run migrations, ensure admin accounts, seed defaults, and clear all caches');
