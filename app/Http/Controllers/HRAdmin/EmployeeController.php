<?php

namespace App\Http\Controllers\HRAdmin;

use App\Http\Controllers\Controller;
use App\Http\Requests\HRAdmin\Employee\StoreRequest;
use App\Http\Requests\HRAdmin\Employee\UpdateRequest;
use App\Http\Services\GeneratePasswordService;
use App\Mail\SendStaffWelcomeEmail;
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
        return view('hradmin.employee.view', compact('employee'));
    }

    public function add()
    {
        $roles = Role::where('name', '!=', 'superadmin')
            ->get();

        return view('hradmin.employee.add', compact('roles'));
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

            //store role
            $user->assign($request->role);

            // Store company relationships
            $user->companies()->attach($company->id);

        });

        return redirect()->route('hradmin.employee.index')->with('successMessage', 'Successfully create user');
    }

    public function edit(User $employee)
    {        
        $roles = Role::where('name', '!=', 'superadmin')
            ->get();

        return view('hradmin.employee.edit', compact('employee','roles'));
    }

    public function update(UpdateRequest $request, User $employee)
    {
        $employee->update([
            'user_name' => $request->user_name,
            'user_email' => $request->user_email,
            'user_language' => $request->user_language,
        ]);

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
