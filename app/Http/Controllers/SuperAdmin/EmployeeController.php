<?php

namespace App\Http\Controllers\superadmin;

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
use App\Models\EmployeeSupervisor;
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
                'employee_id' => $request->employee_id,
                'short_name' => $request->short_name,
                'dob' => $request->dob,
                'gender' => $request->gender,
                'marital_status' => $request->marital_status,
                'home_no' => $request->home_no,
                'mobile_no' => $request->mobile_no,
                'group_join_date' => $request->group_join_date,
                'join_date' => $request->join_date,
                'confirm_date' => $request->confirm_date,
                'increment_date' => $request->increment_date,
                'resign_date' => $request->resign_date,
                'retire_date' => $request->retire_date,
                'probation_end_date' => $request->probation_end_date,
                'work_type' => $request->work_type,
                'designation' => $request->designation,
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
            $user->companies()->attach($request->company);

        });

        return redirect()->route('superadmin.employee.index')->with('successMessage', 'Successfully create user');
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
            ->whereHas('companies', function ($q) use ($employee) {
                $q->where('company_id', $employee->companies->first()->id);
            })
            ->latest()
            ->get();

        return view('superadmin.employee.edit', compact('employee','clients', 'companies', 'roles','settings','supervisors'));
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
            'employee_id' => $request->employee_id,
            'short_name' => $request->short_name,
            'dob' => $request->dob,
            'gender' => $request->gender,
            'marital_status' => $request->marital_status,
            'home_no' => $request->home_no,
            'mobile_no' => $request->mobile_no,
            'group_join_date' => $request->group_join_date,
            'join_date' => $request->join_date,
            'confirm_date' => $request->confirm_date,
            'increment_date' => $request->increment_date,
            'resign_date' => $request->resign_date,
            'retire_date' => $request->retire_date,
            'probation_end_date' => $request->probation_end_date,
            'work_type' => $request->work_type,
            'designation' => $request->designation,
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
        
        //$supervisor_one = EmployeeSupervisor::where('employee_id', $employee->id)->where('level', 1)->first();
        // if($supervisor_one){
        //     //update supervisor
        //     $supervisor_one->update([
        //         'supervisor_id' => $request->supervisor_one,
        //     ]);
        // } else {
        //     //create supervisor
        //     EmployeeSupervisor::create([
        //         'employee_id' => $employee->id,
        //         'supervisor_id' => $request->supervisor_one,
        //         'level' => 1,
        //     ]);
        // }

        // $supervisor_two = EmployeeSupervisor::where('employee_id', $employee->id)->where('level', 2)->first();
        // if($request->supervisor_two){
        //     if($supervisor_two){
        //         //update supervisor
        //         $supervisor_two->update([
        //             'supervisor_id' => $request->supervisor_two,
        //         ]);
        //     } else {
        //         //create supervisor
        //         EmployeeSupervisor::create([
        //             'employee_id' => $employee->id,
        //             'supervisor_id' => $request->supervisor_two,
        //             'level' => 2,
        //         ]);
        //     }
        // }

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
