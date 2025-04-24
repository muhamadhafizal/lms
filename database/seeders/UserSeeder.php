<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Employee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Silber\Bouncer\BouncerFacade as Bouncer;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Create or update the superadmin user
        $member = User::updateOrCreate(
            [
                'user_name' => 'member'
            ], 
            [
                'user_email' => 'member@lms.com',
                'password' => Hash::make('member@1234'), 
                'email_verified_at' => now(),
            ]
        );

        Bouncer::assign('member')->to($member);
    }
}
