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
