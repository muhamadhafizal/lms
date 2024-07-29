<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;

class CompanyController extends Controller
{
    public function index(Request $request)
    {
        $companies = Company::search($request)
            ->latest()
            ->paginate(20)
            ->withQueryString();

        return view('superadmin.company.index', compact('companies', 'request'));
    }
}
