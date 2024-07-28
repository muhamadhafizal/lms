<?php

namespace Database\Seeders;

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
        $superadmin = User::updateOrCreate(
            [
                'user_name' => 'superadmin'
            ], 
            [
                'user_email' => 'superadmin@pms.centralhr.com',
                'password' => Hash::make('superadmin@1234'), 
                'user_language' => 'English',
                'email_verified_at' => now(),
            ]
        );

        Bouncer::assign('superadmin')->to($superadmin);

        // Create or update the HR admin user
        $hradmin = User::updateOrCreate(
            [
                'user_name' => 'hradmin'
            ], 
            [
                'user_email' => 'hradmin@pms.centralhr.com',
                'password' => Hash::make('hradmin@1234'), 
                'user_language' => 'English',
                'email_verified_at' => now(),
            ]
        );

        Bouncer::assign('hradmin')->to($hradmin);

        // Create or update the supervisor user
        $supervisor = User::updateOrCreate(
            [
                'user_name' => 'supervisor'
            ], 
            [
                'user_email' => 'supervisor@pms.centralhr.com',
                'password' => Hash::make('supervisor@1234'), 
                'user_language' => 'English',
                'email_verified_at' => now(),
            ]
        );

        Bouncer::assign('supervisor')->to($supervisor);

        // Create or update the employee user
        $employee = User::updateOrCreate(
            [
                'user_name' => 'employee'
            ], 
            [
                'user_email' => 'employee@pms.centralhr.com',
                'password' => Hash::make('employee@1234'), 
                'user_language' => 'English',
                'email_verified_at' => now(),
            ]
        );

        Bouncer::assign('employee')->to($employee);
    }
}
