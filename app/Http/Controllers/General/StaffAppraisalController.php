<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use App\Models\AppraisalSetup;
use App\Models\EmployeeFeedbackSetup;
use App\Models\SupervisorFeedbackSetup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StaffAppraisalController extends Controller
{
    public function index(Request $request)
    {
        $appraisalSetups = Auth::user()
        ->appraisalSetups() // Use () to get the query builder
        ->paginate(10);

        return view('general.staff.appraisal.index', compact('request','appraisalSetups'));
    }

    public function view(AppraisalSetup $appraisalSetup)
    {
        $appraisalSetup->load([
            'appraisalParts',
        ]);

        $appraisalParts = $appraisalSetup->appraisalParts()->get()->map(function ($part) {
            $part->related_model = $part->relatedModel(); // Call the metho

            return $part;
        });

        $employeeFeedback =  EmployeeFeedbackSetup::where('is_active', 1)
            ->where('company_id', $appraisalSetup->company_id)
            ->first();

        $supervisorFeedback =  SupervisorFeedbackSetup::where('is_active', 1)
            ->where('company_id', $appraisalSetup->company_id)
            ->first();

        return view('general.staff.appraisal.view', compact('appraisalSetup', 'appraisalParts','employeeFeedback','supervisorFeedback'));
    }
}
