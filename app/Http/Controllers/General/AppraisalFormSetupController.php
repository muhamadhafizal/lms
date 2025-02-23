<?php

namespace App\Http\Controllers\General;

use App\Enums\FormSetupCategory;
use App\Http\Controllers\Controller;
use App\Http\Requests\General\Appraisal\FormSetup\StorePartRequest;
use App\Http\Requests\General\Appraisal\FormSetup\StoreRequest;
use App\Models\AppraisalPart;
use App\Models\AppraisalSetup;
use App\Models\AppraisalStaff;
use App\Models\BatchSetup;
use App\Models\Client;
use App\Models\Company;
use App\Models\Employee;
use App\Models\EmployeeFeedbackSetup;
use App\Models\KBAForm;
use App\Models\KRAHeaderSetup;
use App\Models\SupervisorFeedbackSetup;
use App\Models\User;
use Illuminate\Http\Request;

class AppraisalFormSetupController extends Controller
{
    public function index(Request $request)
    {
        $appraisalSetups = AppraisalSetup::with([
            'company'
        ])
        ->roles(auth()->user()->getRoles()[0])
        ->search($request)
        ->latest()
        ->paginate(20)
        ->withQueryString();

        return view('general.appraisals.form-setup.index', compact('request','appraisalSetups'));
    }

    public function add()
    {
        $clients = Client::where('is_active', 1)
            ->where('is_subscribed', 1)
            ->get();

        $companies = Company::where('is_active', 1)
            ->get(); 
        
        $categories = FormSetupCategory::cases();

        $batchSetups = BatchSetup::where('active', 1)
            ->get();
        

        return view('general.appraisals.form-setup.add', compact('clients', 'companies','categories','batchSetups'));
    }

    public function store(StoreRequest $request)
    {
        $appraisalSetup = AppraisalSetup::create([
            'company_id' => $request->company,
            'batch_id' => $request->batch_setup_id,
            'code' => $request->code,
            'description' => $request->description,
            'category' => $request->category,
            'review_start_date' => $request->review_start_date,
            'review_end_date' => $request->review_end_date,
            'rating_start_date' => $request->rating_start_date,
            'rating_end_date' => $request->rating_end_date,
        ]);

        return to_route( auth()->user()->getRoles()[0].'.appraisals.form-setups.index')->with('successMessage', 'Successfully add new form setup');
    }

    public function edit(AppraisalSetup $appraisalSetup)
    {
        $clients = Client::where('is_active', 1)
        ->where('is_subscribed', 1)
        ->get();

        $companies = Company::where('is_active', 1)
            ->get(); 
        
        $categories = FormSetupCategory::cases();

        $batchSetups = BatchSetup::where('active', 1)
            ->get();

        return view('general.appraisals.form-setup.edit', compact('appraisalSetup', 'clients', 'companies','categories','batchSetups'));
    }

    public function update(StoreRequest $request, AppraisalSetup $appraisalSetup)
    {
        $appraisalSetup->update($request->all());

        return to_route( auth()->user()->getRoles()[0].'.appraisals.form-setups.index')->with('successMessage', 'Successfully update form setup');
    }

    public function view(AppraisalSetup $appraisalSetup)
    {
        $appraisalParts = $appraisalSetup->appraisalParts()->get()->map(function ($part) {
            $part->related_model = $part->relatedModel(); // Call the method
            return $part;
        });

        $appraisalStaffs = $appraisalSetup->appraisalStaffs->load([
            'user.employee',
            'user.companies',
        ]);

        //KRA
        $kraSetups = KRAHeaderSetup::with([
            'company'
        ])
        ->where('company_id', $appraisalSetup->company_id)
        ->get();

        //KBA
        $kbaForms = KBAForm::with([
            'company'
        ])
        ->where('company_id', $appraisalSetup->company_id)
        ->get();

        $listOfParts = [
            'KRA' => $kraSetups,
            'KBA' => $kbaForms,
        ];

        //ListOfStaffs
        $listOfStaffs = User::with('companies.client')
            ->role(['supervisor', 'employee'])
            ->whereHas('companies', function ($query) use ($appraisalSetup) {
                $query->where('companies.id', $appraisalSetup->company_id);
            })
            ->get();

        return view('general.appraisals.form-setup.view', compact('appraisalSetup','appraisalParts','listOfParts','appraisalStaffs','listOfStaffs'));
    }

    public function partStore(StorePartRequest $request,AppraisalSetup $appraisalSetup)
    {
        [$group, $partId] = explode('|', $request->part_id);

        $aprraisalPart = AppraisalPart::create([
            'appraisal_setup_id' => $appraisalSetup->id,
            'part_id' => $partId,
            'model' => $group,
            'title' => $request->title,
            'weightage' => $request->weightage,
        ]); 

        return to_route( auth()->user()->getRoles()[0].'.appraisals.form-setups.view', $appraisalSetup)->with('successMessage', 'Successfully add new part');
    }

    public function partDelete(AppraisalPart $appraisalPart)
    {
        $appraisalPart->delete();

        return back()->with('successMessage', 'Successfully delete part');
    }

    public function partUpdate(Request $request,AppraisalPart $appraisalPart)
    {
        $appraisalPart->update($request->all());

        return back()->with('successMessage', 'Successfully update part');
    }

    public function staffStore(Request $request,AppraisalSetup $appraisalSetup)
    {
        $request->validate([
            'staff_id' => 'required|array', // Ensure it's an array
            'staff_id.*' => 'exists:users,id' // Validate each selected ID
        ]);

        foreach ($request->staff_id as $staffId) {
            if (AppraisalStaff::where('appraisal_setup_id', $appraisalSetup->id)
                ->where('user_id', $staffId)
                ->exists()) {
                return back()->with('errorMessage', 'This staff is already added');
            }
            AppraisalStaff::create([
                'appraisal_setup_id' => $appraisalSetup->id,
                'user_id' => $staffId,
            ]);
            //send email
        }

        return back()->with('successMessage', 'Successfully add new staff');
        
    }

    public function staffDelete(AppraisalStaff $appraisalStaff)
    {
        $appraisalStaff->delete();

        return back()->with('successMessage', 'Successfully delete staff');
    }
}
