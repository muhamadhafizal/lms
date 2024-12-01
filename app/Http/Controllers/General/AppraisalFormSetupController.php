<?php

namespace App\Http\Controllers\General;

use App\Enums\FormSetupCategory;
use App\Http\Controllers\Controller;
use App\Http\Requests\General\Appraisal\FormSetup\StoreRequest;
use App\Models\AppraisalSetup;
use App\Models\BatchSetup;
use App\Models\Client;
use App\Models\Company;
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
        $appraisalParts = $appraisalSetup->appraisalParts()->get();

        return view('general.appraisals.form-setup.view', compact('appraisalSetup','appraisalParts'));
    }
}
