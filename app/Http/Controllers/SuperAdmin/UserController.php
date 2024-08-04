<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Superadmin\User\StoreRequest;
use App\Http\Requests\Superadmin\User\UpdatePasswordRequest;
use App\Http\Requests\Superadmin\User\UpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Silber\Bouncer\Bouncer;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $staffs = User::whereHas('roles', function ($query){
                $query->where('name','superadmin');
            })
            ->latest()
            ->paginate(20)
            ->withQueryString();

        return view('superadmin.user.index', compact('request','staffs'));
    }

    public function store(StoreRequest $request)
    {
        $user = User::create([
            'user_name' => $request->user_name,
            'user_email' => $request->user_email,
            'user_language' => $request->user_language,
            'password' => Hash::make('superadmin@1234'), 
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
}
