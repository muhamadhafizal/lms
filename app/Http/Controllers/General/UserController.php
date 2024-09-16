<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getUsers($company_id)
    {
        $supervisors = User::role(['supervisor'])
            ->whereHas('companies', function ($q) use ($company_id) {
                $q->where('company_id', $company_id);
            })
            ->where('user_status',1)
            ->latest()
            ->get();
        
        return response()->json($supervisors);
    }
}
