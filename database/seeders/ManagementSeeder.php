<?php

namespace Database\Seeders;

use App\Models\Management;
use Illuminate\Database\Seeder;

class ManagementSeeder extends Seeder
{
    public function run()
    {
        // কেন্দ্রীয় দায়িত্বশীল
        Management::create([
            'name' => 'মাওলানা আব্দুল্লাহ',
            'designation' => 'সভাপতি',
            'level' => 'central',
            'phone' => '01712345678',
            'email' => 'president@example.com',
            'address' => 'ঢাকা',
            'status' => true,
            'order' => 1
        ]);

        Management::create([
            'name' => 'মাওলানা রহমান',
            'designation' => 'সেক্রেটারি জেনারেল',
            'level' => 'central',
            'phone' => '01812345678',
            'email' => 'secretary@example.com',
            'address' => 'ঢাকা',
            'status' => true,
            'order' => 2
        ]);

        Management::create([
            'name' => 'মাওলানা করিম',
            'designation' => 'সহ-সভাপতি',
            'level' => 'central',
            'phone' => '01912345678',
            'email' => 'vp@example.com',
            'address' => 'ঢাকা',
            'status' => true,
            'order' => 3
        ]);

        // শাখা দায়িত্বশীল
        Management::create([
            'name' => 'মাওলানা সালেহ',
            'designation' => 'শাখা সভাপতি',
            'level' => 'branch',
            'area' => 'মিরপুর শাখা',
            'phone' => '01712345679',
            'email' => 'mirpur@example.com',
            'address' => 'মিরপুর-১০, ঢাকা',
            'status' => true,
            'order' => 1
        ]);

        Management::create([
            'name' => 'মাওলানা হাসান',
            'designation' => 'শাখা সভাপতি',
            'level' => 'branch',
            'area' => 'মোহাম্মদপুর শাখা',
            'phone' => '01812345679',
            'email' => 'mohammadpur@example.com',
            'address' => 'মোহাম্মদপুর, ঢাকা',
            'status' => true,
            'order' => 2
        ]);

        Management::create([
            'name' => 'মাওলানা ইমরান',
            'designation' => 'শাখা সভাপতি',
            'level' => 'branch',
            'area' => 'উত্তরা শাখা',
            'phone' => '01912345679',
            'email' => 'uttara@example.com',
            'address' => 'উত্তরা, ঢাকা',
            'status' => true,
            'order' => 3
        ]);
    }
}
