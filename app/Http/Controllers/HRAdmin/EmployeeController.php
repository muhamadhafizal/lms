<?php

namespace App\Http\Controllers\HRAdmin;

use App\Http\Controllers\Controller;
use App\Http\Requests\HRAdmin\Employee\StoreRequest;
use App\Http\Requests\HRAdmin\Employee\UpdateRequest;
use App\Http\Services\GeneratePasswordService;
use App\Http\Services\SettingService;
use App\Mail\SendStaffWelcomeEmail;
use App\Models\Employee;
use App\Models\EmployeeSupervisor;
use App\Models\Role;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mail;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $employees = User::with('companies.client')
            ->whereHas('companies', function ($q) {
                $q->whereIn('company_id', auth()->user()->companies->pluck('id'));
            })
            ->role(['hradmin','supervisor','employee'])
            ->latest()
            ->paginate(20)
            ->withQueryString();

        return view('hradmin.employee.index', compact('request','employees'));
    }

    public function view(User $employee)
    {
        $employee = $employee->load([
                'employee',
                'employee.supervisors.supervisor.user',
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

        return view('hradmin.employee.view', compact('employee'));
    }

    public function add()
    {
        $settings = SettingService::getSettings();

        $roles = Role::where('name', '!=', 'superadmin')
            ->get();

        $supervisors = User::role(['supervisor'])
            ->whereHas('companies', function ($q) {
                $q->whereIn('company_id', auth()->user()->companies->pluck('id'));
            })
            ->latest()
            ->get();
            
        return view('hradmin.employee.add', compact('roles','settings','supervisors'));
    }

    public function store(StoreRequest $request)
    {
        //get User Auth Company
        $company = auth()->user()->companies->first();
   
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
        DB::transaction(function () use ($request, $password, $company) {
            
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
                'security_group_id' => $request->securityGroup,
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

            // Define an array of supervisors
            $supervisors = [
                ['supervisor_id' => $request->supervisor_one, 'level' => 1],
                ['supervisor_id' => $request->supervisor_two, 'level' => 2],
            ];

            // Loop through supervisors and create records
            foreach ($supervisors as $supervisor) {
                if ($supervisor['supervisor_id']) {
                    EmployeeSupervisor::create([
                        'employee_id' => $user->id,
                        'supervisor_id' => $supervisor['supervisor_id'],
                        'level' => $supervisor['level'],
                    ]);
                }
            }

            //store role
            $user->assign($request->role);

            // Store company relationships
            $user->companies()->attach($company->id);

        });

        return redirect()->route('hradmin.employee.index')->with('successMessage', 'Successfully create user');
    }

    public function edit(User $employee)
    {     
        $settings = SettingService::getSettings();
        
        $roles = Role::where('name', '!=', 'superadmin')
            ->get();
        
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
        
        $supervisors = User::role(['supervisor'])
            ->whereHas('companies', function ($q) {
                $q->whereIn('company_id', auth()->user()->companies->pluck('id'));
            })
            ->latest()
            ->get();

        return view('hradmin.employee.edit', compact('employee','roles','settings','supervisors'));
    }

    public function update(UpdateRequest $request, User $employee)
    {
        $employee->update([
            'user_name' => $request->user_name,
            'user_email' => $request->user_email,
            'user_language' => $request->user_language,
        ]);

        $employee->employee->update([
            'security_group_id' => $request->securityGroup,
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

        // Attach security groups
        if ($request->has('userSecurityGroups')) {
            $employee->securityGroups()->sync($request->input('userSecurityGroups'));
        } else {
            $employee->securityGroups()->detach(); // Remove all security groups if none are selected
        }

        //Update supervisor
        if($request->supervisor_one){
             // Handle Supervisor 1
            EmployeeSupervisor::updateOrCreate(
                ['employee_id' => $employee->id, 'level' => 1],
                ['supervisor_id' => $request->supervisor_one]
            );

            // Handle Supervisor 2 (if provided)
            if ($request->supervisor_two) {
                EmployeeSupervisor::updateOrCreate(
                    ['employee_id' => $employee->id, 'level' => 2],
                    ['supervisor_id' => $request->supervisor_two]
                );
            }
        }
       
        $employee->roles()->sync($request->role);

        return redirect()->route('hradmin.employee.view', $employee)->with('successMessage', 'Successfully update user');
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
