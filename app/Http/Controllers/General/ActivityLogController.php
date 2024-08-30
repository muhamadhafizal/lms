<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ActivityLogController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        $activities = Activity::with('user')
                ->when($user->getRoles()[0] !== 'superadmin', function ($query) use ($user) {
                    return $query->where('causer_id', $user->id);
                })
                ->search($request)
                ->latest()
                ->paginate(20)
                ->withQueryString();

        return view('general.activitylog.index', compact('activities', 'request'));
    }
}
