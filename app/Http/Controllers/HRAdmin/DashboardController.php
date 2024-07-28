<?php

namespace App\Http\Controllers\HRAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('hradmin.dashboard.index');
    }
}
