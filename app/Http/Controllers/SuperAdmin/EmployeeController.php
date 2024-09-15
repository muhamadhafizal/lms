<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Superadmin\Employee\UpdateRequest;
use App\Http\Requests\Superadmin\Employee\StoreRequest;
use App\Models\Client;
use App\Models\Company;
use App\Models\Role;
use Illuminate\Http\Request;
use Exception;
use Mail;
use App\Mail\SendStaffWelcomeEmail;
use App\Http\Services\GeneratePasswordService;
use App\Http\Services\SettingService;
use App\Models\Employee;
use App\Models\User;
use Database\Seeders\SettingSeeder;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $employees = User::with('companies.client')
            ->role(['hradmin','supervisor','employee'])
            ->latest()
            ->paginate(20)
            ->withQueryString();
            
        return view('superadmin.employee.index', compact('request','employees'));
    }

    public function add()
    {
        $settings = SettingService::getSettings();

        $clients = Client::where('is_active', 1)
            ->where('is_subscribed', 1)
            ->get();

        $companies = Company::where('is_active', 1)
            ->get(); 
        
        $roles = Role::where('name', '!=', 'superadmin')
            ->get();


        return view('superadmin.employee.add', compact('clients', 'companies', 'roles','settings'));
    }

    public function store(StoreRequest $request)
    {
        //password set dumy
        $plainpassword = generateToken(5);
        
        //send email notification
        try {
           
            Mail::to($request->user_email)
                ->send(new SendStaffWelcomeEmail($request->user_email, $plainpassword, $request->user_name));
            
        } catch (Exception) {

            $error_message = 'There was an error accessing the SMTP server. Please contact your system administrator for assistance.';

            return back()
                ->with('errorMessage', $error_message)
                ->withInput();
        }
        
        //hashpassword
        $password = GeneratePasswordService::getPassword($plainpassword);

        //Using DB Transaction
        DB::transaction(function () use ($request, $password) {
            
            //store user
            $user = User::create([
                'user_name' => $request->user_name,
                'user_email' => $request->user_email,
                'user_language' => $request->user_language,
                'password' => $password, 
                'email_verified_at' => now(),
            ]);

            //store employee
            Employee::create([
                'user_id' => $user->id,
                'race_id' => $request->race,
                'religion_id' => $request->religion,
                'nationality_id' => $request->nationality,
                'work_location_id' => $request->workLocation,
                'cost_centre_id' => $request->costCentre,
                'department_id' => $request->department,
                'section_id' => $request->section,
                'category_id' => $request->category,
                'job_grade_id' => $request->jobGrade,
                'business_unit_id' => $request->businessUnit,
                'qualification_id' => $request->qualification,
            ]);

            //store role
            $user->assign($request->role);

            // Store company relationships
            $user->companies()->attach($request->company);

        });

        return redirect()->route('superadmin.employee.index')->with('successMessage', 'Successfully create user');
    }

    public function view(User $employee)
    {
        $employee = $employee->load([
            'employee',
            'employee.race',
            'employee.religion',
            'employee.nationality',
            'employee.workLocation',
            'employee.costCentre',
            'employee.department',
            'employee.section',
            'employee.category',
            'employee.jobGrade',
            'employee.businessUnit',
            'employee.qualification',
        ]);
      
        return view('superadmin.employee.view', compact('employee'));
    }

    public function edit(User $employee)
    {
        $settings = SettingService::getSettings();

        $clients = Client::where('is_active', 1)
            ->where('is_subscribed', 1)
            ->get();

        $companies = Company::where('is_active', 1)
            ->get(); 
        
        $roles = Role::where('name', '!=', 'superadmin')
            ->get();

        return view('superadmin.employee.edit', compact('employee','clients', 'companies', 'roles','settings'));
    }

    public function update(UpdateRequest $request, User $employee)
    {
        $employee->update([
            'user_name' => $request->user_name,
            'user_email' => $request->user_email,
            'user_language' => $request->user_language,
        ]);

        $employee->employee->update([
            'race_id' => $request->race,
            'religion_id' => $request->religion,
            'nationality_id' => $request->nationality,
            'work_location_id' => $request->workLocation,
            'cost_centre_id' => $request->costCentre,
            'department_id' => $request->department,
            'section_id' => $request->section,
            'category_id' => $request->category,
            'job_grade_id' => $request->jobGrade,
            'business_unit_id' => $request->businessUnit,
            'qualification_id' => $request->qualification,
        ]);

        $employee->roles()->sync($request->role);

        $employee->companies()->sync($request->company);

        return redirect()->route('superadmin.employee.view', $employee)->with('successMessage', 'Successfully update user');

    }

    public function resend(User $employee)
    {
         //password set dumy
         $plainpassword = generateToken(5);
        
         //send email notification
         try {
            
             Mail::to($employee->user_email)
                 ->send(new SendStaffWelcomeEmail($employee->user_email, $plainpassword, $employee->user_name));
             
         } catch (Exception) {
 
             $error_message = 'There was an error accessing the SMTP server. Please contact your system administrator for assistance.';
 
             return back()
                 ->with('errorMessage', $error_message)
                 ->withInput();
         }
       
         $password = GeneratePasswordService::getPassword($plainpassword);

         $employee->update([
             'password' => $password, 
         ]);

        return redirect()->back()->with('successMessage', 'Successfully resend email verification');
    }
    
}
