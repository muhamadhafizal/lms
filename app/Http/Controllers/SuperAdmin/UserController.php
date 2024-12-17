<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Superadmin\User\StoreRequest;
use App\Http\Requests\Superadmin\User\UpdatePasswordRequest;
use App\Http\Requests\Superadmin\User\UpdateRequest;
use App\Http\Services\GeneratePasswordService;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Exception;
use Mail;
use App\Mail\SendStaffWelcomeEmail;


class UserController extends Controller
{
    public function index(Request $request)
    {
        $staffs = User::role(['superadmin'])
            ->latest()
            ->paginate(20)
            ->withQueryString();

        return view('superadmin.user.index', compact('request','staffs'));
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
      
        $password = GeneratePasswordService::getPassword($plainpassword);

        $user = User::create([
            'user_name' => $request->user_name,
            'user_email' => $request->user_email,
            'user_language' => $request->user_language,
            'password' => $password, 
            'email_verified_at' => now(),
        ]);

        $user->assign('superadmin');

        return redirect()->back()->with('successMessage', 'Successfully update user');
    }

    public function update(UpdateRequest $request, User $user)
    {
        $user->update([
            'user_name' => $request->user_name,
            'user_email' => $request->user_email,
            'user_status' => $request->user_status,
            'user_language' => $request->user_language,
        ]);

        return redirect()->back()->with('successMessage', 'Successfully update user');
    }

    public function updatepassword(UpdatePasswordRequest $request, User $user)
    {
        $user->update([
            'password' => bcrypt($request->password),
        ]);

        return redirect()->back()->with('successMessage', 'Successfully update password user');
    }

    public function resend(User $user)
    {
         //password set dumy
         $plainpassword = generateToken(5);
        
         //send email notification
         try {
            
             Mail::to($user->user_email)
                 ->send(new SendStaffWelcomeEmail($user->user_email, $plainpassword, $user->user_name));
             
         } catch (Exception) {
 
             $error_message = 'There was an error accessing the SMTP server. Please contact your system administrator for assistance.';
 
             return back()
                 ->with('errorMessage', $error_message)
                 ->withInput();
         }
       
         $password = GeneratePasswordService::getPassword($plainpassword);

         $user->update([
             'password' => $password, 
         ]);

        return redirect()->back()->with('successMessage', 'Successfully resend email verification');
    }
}
