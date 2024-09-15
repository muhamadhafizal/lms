<?php

namespace App\Http\Services;

use Exception;
use Illuminate\Support\Facades\Hash;
use App\Models\BusinessUnit;
use App\Models\Category;
use App\Models\CostCentre;
use App\Models\Department;
use App\Models\JobGrade;
use App\Models\Nationality;
use App\Models\Qualification;
use App\Models\Race;
use App\Models\Religion;
use App\Models\Section;
use App\Models\WorkLocation;

class SettingService
{

    /**
     * Get hashed password with salt
     */
    public static function getSettings()
    {
        $races = Race::where('active', 1)->get();
        $religions = Religion::where('active', 1)->get();
        $nationalities = Nationality::where('active', 1)->get();
        $workLocations = WorkLocation::where('active', 1)->get();
        $costCentre = CostCentre::where('active', 1)->get();
        $departments = Department::where('active', 1)->get();
        $sections = Section::where('active', 1)->get();
        $categories = Category::where('active', 1)->get();
        $jobGrades = JobGrade::where('active', 1)->get();
        $businessUnits = BusinessUnit::where('active', 1)->get();
        $qualifications = Qualification::where('active', 1)->get();

        $settingsArray = [
            'races' => $races,
            'religions' => $religions,
            'nationalities' => $nationalities,
            'workLocations' => $workLocations,
            'costCentres' => $costCentre,
            'departments' => $departments,
            'sections' => $sections,
            'categories' => $categories,
            'jobGrades' => $jobGrades,
            'businessUnits' => $businessUnits,
            'qualifications' => $qualifications
        ];

        return $settingsArray;
    }
}
