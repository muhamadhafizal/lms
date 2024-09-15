<?php

namespace Database\Seeders;

use App\Models\BusinessUnit;
use App\Models\Category;
use App\Models\CostCentre;
use App\Models\Department;
use App\Models\JobGrade;
use App\Models\Nationality;
use App\Models\Qualification;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Race;
use App\Models\Religion;
use App\Models\Section;
use App\Models\WorkLocation;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $races = [
            ['name' => 'Malay'],
            ['name' => 'Chinese'],
            ['name' => 'Indian'],
            ['name' => 'Others'],
        ];

        foreach ($races as $race) {
            Race::updateOrCreate(
                ['name' => $race['name']] // Update or create
            );
        }

        $religions = [
            ['name' => 'Islam'],
            ['name' => 'Buddhism'],
            ['name' => 'Christianity'],
            ['name' => 'Hinduism'],
            ['name' => 'Other'],
        ];

        foreach ($religions as $religion) {
            Religion::updateOrCreate(
                ['name' => $religion['name']]
            );
        }

        $nationalities = [
            ['name' => 'Malaysian'],
            ['name' => 'Indonesian'],
            ['name' => 'Indian'],
            ['name' => 'Chinese'],
            ['name' => 'Other'],
        ];

        foreach ($nationalities as $nationality) {
            Nationality::updateOrCreate(
                ['name' => $nationality['name']]
            );
        }

        $states = [
            ['name' => 'Johor'],
            ['name' => 'Kedah'],
            ['name' => 'Kelantan'],
            ['name' => 'Melaka'],
            ['name' => 'Negeri Sembilan'],
            ['name' => 'Pahang'],
            ['name' => 'Perak'],
            ['name' => 'Perlis'],
            ['name' => 'Penang'],
            ['name' => 'Sabah'],
            ['name' => 'Sarawak'],
            ['name' => 'Selangor'],
            ['name' => 'Terengganu'],
            ['name' => 'Kuala Lumpur'],
            ['name' => 'Labuan'],
            ['name' => 'Putrajaya'],
        ];

        foreach ($states as $state) {
            WorkLocation::updateOrCreate(
                ['name' => $state['name']],
            );
        }

        $costCentres = [
            ['name' => 'Finance', 'code' => 'CC001'],
            ['name' => 'Human Resources', 'code' => 'CC002'],
            ['name' => 'IT', 'code' => 'CC003'],
            ['name' => 'Sales', 'code' => 'CC004'],
            ['name' => 'Operations', 'code' => 'CC005'],
        ];

        foreach ($costCentres as $costCentre) {
            CostCentre::updateOrCreate(
                ['code' => $costCentre['code']], // Check by code since it’s unique
                ['name' => $costCentre['name']]
            );
        }

        $departments = [
            ['name' => 'Human Resources'],
            ['name' => 'Finance'],
            ['name' => 'IT'],
            ['name' => 'Sales'],
            ['name' => 'Operations'],
        ];

        foreach ($departments as $department) {
            Department::updateOrCreate(
                ['name' => $department['name']]
            );
        }

        $sections = [
            ['name' => 'Administration'],
            ['name' => 'Engineering'],
            ['name' => 'Human Resources'],
            ['name' => 'Operations'],
            ['name' => 'Finance'],
        ];

        foreach ($sections as $section) {
            Section::updateOrCreate(
                ['name' => $section['name']]
            );
        }

        $categories = [
            ['name' => 'Permanent'],
            ['name' => 'Contract'],
            ['name' => 'Internship'],
            ['name' => 'Part-Time'],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(
                ['name' => $category['name']]
            );
        }

        $jobGrades = [
            ['name' => 'Grade A'],
            ['name' => 'Grade B'],
            ['name' => 'Grade C'],
            ['name' => 'Grade D'],
            ['name' => 'Grade E'],
        ];

        foreach ($jobGrades as $jobGrade) {
            JobGrade::updateOrCreate(
                ['name' => $jobGrade['name']]
            );
        }

        $businessUnits = [
            ['name' => 'IT Solutions'],
            ['name' => 'Retail Operations'],
            ['name' => 'Manufacturing'],
            ['name' => 'Logistics'],
            ['name' => 'Customer Support'],
        ];

        foreach ($businessUnits as $unit) {
            BusinessUnit::updateOrCreate(
                ['name' => $unit['name']]
            );
        }

        $qualifications = [
            ['name' => 'SPM (Sijil Pelajaran Malaysia)'],
            ['name' => 'Diploma'],
            ['name' => 'Bachelor\'s Degree'],
            ['name' => 'Master\'s Degree'],
            ['name' => 'PhD'],
            ['name' => 'Certificate'],
        ];

        foreach ($qualifications as $qualification) {
            Qualification::updateOrCreate(
                ['name' => $qualification['name']]
            );
        }


    }
}
