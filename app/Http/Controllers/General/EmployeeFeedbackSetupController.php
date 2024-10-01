<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use App\Http\Requests\General\Setups\EmployeeFeedback\StoreQuestionRequest;
use App\Http\Requests\General\Setups\EmployeeFeedback\StoreRequest;
use App\Http\Requests\General\Setups\EmployeeFeedback\UpdateQuestionRequest;
use App\Http\Requests\General\Setups\EmployeeFeedback\UpdateRequest;
use App\Models\Client;
use App\Models\Company;
use App\Models\Employee;
use App\Models\EmployeeFeedbackQuestion;
use App\Models\EmployeeFeedbackSetup;
use Illuminate\Http\Request;

class EmployeeFeedbackSetupController extends Controller
{
    public function index(Request $request)
    {
        $employeeFeedbacks = EmployeeFeedbackSetup::with([
            'company'
        ])
        ->latest()
        ->paginate(20)
        ->withQueryString();

        return view('general.setups.employeeFeedback.index', compact('employeeFeedbacks', 'request'));
    }

    public function add()
    {
        $clients = Client::where('is_active', 1)
            ->where('is_subscribed', 1)
            ->get();

        $companies = Company::where('is_active', 1)
            ->get(); 
        
        return view('general.setups.employeeFeedback.add', compact('clients', 'companies'));
    }


    public function store(StoreRequest $request)
    {
        $employeeFeedback = EmployeeFeedbackSetup::create([
            'company_id' => $request->company,
            'code' => $request->code,
            'description' => $request->description,
        ]);

        return to_route( auth()->user()->getRoles()[0].'.setups.employee-feedback.view', $employeeFeedback->id)->with('successMessage', 'Successfully add new employee feedback setup');
    }

    public function view(EmployeeFeedbackSetup $employeeFeedback)
    {
        $employeeFeedback->load([
                'company.client',
                'questions'
            ]);

        return view('general.setups.employeeFeedback.view', compact('employeeFeedback'));
    }

    public function edit(EmployeeFeedbackSetup $employeeFeedback)
    {
        $clients = Client::where('is_active', 1)
        ->where('is_subscribed', 1)
        ->get();

        $companies = Company::where('is_active', 1)
            ->get(); 

        return view('general.setups.employeeFeedback.edit', compact('employeeFeedback', 'clients', 'companies'));
    }

    public function update(UpdateRequest $request, EmployeeFeedbackSetup $employeeFeedback)
    {
        $employeeFeedback->update([
            'code' => $request->code,
            'description' => $request->description,
            'is_active' => $request->active,
        ]);

        return to_route( auth()->user()->getRoles()[0].'.setups.employee-feedback.view', $employeeFeedback->id)->with('successMessage', 'Successfully update employee feedback setup');
    }

    public function storeQuestion(StoreQuestionRequest $request)
    { 
        $employeeFeedbackQuestion = EmployeeFeedbackQuestion::create([
            'efs_id' => $request->employee_feedback_id,
            'question' => $request->question,
        ]);

        return redirect()->back()->with('successMessage', 'Successfully add new question');
    }

    public function updateQuestion(UpdateQuestionRequest $request, EmployeeFeedbackQuestion $employeeFeedbackQuestion)
    {
        $employeeFeedbackQuestion->update([
            'question' => $request->question,
        ]);

        return redirect()->back()->with('successMessage', 'Successfully update question');
    }
}
