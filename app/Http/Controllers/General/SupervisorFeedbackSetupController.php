<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use App\Http\Requests\General\Setups\SupervisorFeedback\UpdateQuestionRequest;
use App\Http\Requests\General\Setups\SupervisorFeedback\StoreQuestionRequest;
use App\Http\Requests\General\Setups\SupervisorFeedback\StoreRequest;
use App\Http\Requests\General\Setups\SupervisorFeedback\UpdateRequest;
use App\Models\Client;
use App\Models\Company;
use App\Models\SupervisorFeedbackQuestion;
use App\Models\SupervisorFeedbackSetup;
use Illuminate\Http\Request;

class SupervisorFeedbackSetupController extends Controller
{
    public function index(Request $request)
    {
        $supervisorFeedbacks = SupervisorFeedbackSetup::with([
            'company'
        ])
        ->latest()
        ->paginate(20)
        ->withQueryString();

        return view('general.setups.supervisorFeedback.index', compact('supervisorFeedbacks', 'request'));
    }

    public function add()
    {
        $clients = Client::where('is_active', 1)
            ->where('is_subscribed', 1)
            ->get();

        $companies = Company::where('is_active', 1)
            ->get(); 
        
        return view('general.setups.supervisorFeedback.add', compact('clients', 'companies'));
    }


    public function store(StoreRequest $request)
    {
        $supervisorFeedback = SupervisorFeedbackSetup::create([
            'company_id' => $request->company,
            'code' => $request->code,
            'description' => $request->description,
        ]);

        return to_route( auth()->user()->getRoles()[0].'.setups.supervisor-feedback.view', $supervisorFeedback->id)->with('successMessage', 'Successfully add new supervisor feedback setup');
    }

    public function view(SupervisorFeedbackSetup $supervisorFeedback)
    {
        $supervisorFeedback->load([
                'company.client',
                'questions'
            ]);

        return view('general.setups.supervisorFeedback.view', compact('supervisorFeedback'));
    }

    public function edit(SupervisorFeedbackSetup $supervisorFeedback)
    {
        $clients = Client::where('is_active', 1)
        ->where('is_subscribed', 1)
        ->get();

        $companies = Company::where('is_active', 1)
            ->get(); 

        return view('general.setups.supervisorFeedback.edit', compact('supervisorFeedback', 'clients', 'companies'));
    }

    public function update(UpdateRequest $request, SupervisorFeedbackSetup $supervisorFeedback)
    {
        $supervisorFeedback->update([
            'code' => $request->code,
            'description' => $request->description,
            'is_active' => $request->active,
        ]);

        return to_route( auth()->user()->getRoles()[0].'.setups.supervisor-feedback.view', $supervisorFeedback->id)->with('successMessage', 'Successfully update supervisor feedback setup');
    }

    public function storeQuestion(StoreQuestionRequest $request)
    { 
        $supervisorFeedbackQuestion = SupervisorFeedbackQuestion::create([
            'sfs_id' => $request->supervisor_feedback_id,
            'question' => $request->question,
        ]);

        return redirect()->back()->with('successMessage', 'Successfully add new question');
    }

    public function updateQuestion(UpdateQuestionRequest $request, SupervisorFeedbackQuestion $supervisorFeedbackQuestion)
    {
        $supervisorFeedbackQuestion->update([
            'question' => $request->question,
        ]);

        return redirect()->back()->with('successMessage', 'Successfully update question');
    }
}
