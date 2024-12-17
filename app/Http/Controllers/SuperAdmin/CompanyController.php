<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Superadmin\Company\StoreRequest;
use App\Http\Requests\Superadmin\Company\UpdateRequest;
use App\Models\Client;
use Illuminate\Http\Request;
use App\Models\Company;

class CompanyController extends Controller
{
    public function index(Request $request)
    {
        $companies = Company::with(['client:id,name'])
            ->search($request)
            ->latest()
            ->paginate(20)
            ->withQueryString();

        return view('superadmin.company.index', compact('companies', 'request'));
    }

    public function add()
    {
        $clients = Client::where('is_active',1)
                ->where('is_subscribed',1)
                ->get();

        return view('superadmin.company.add', compact('clients'));
    }

    public function store(StoreRequest $request)
    {
        $company = Company::create([
            'client_id' => $request->client_id,
            'name' => $request->name,
            'former_name' => $request->former_name,
            'roc_one' => $request->roc_one,
            'roc_two' => $request->roc_two,
            'contact' => $request->contact,
            'fax' => $request->fax,
            'email' => $request->email,
            'time_zone' => $request->time_zone,
            'registration_date' => $request->registration_date,
            'invoice_date' => $request->invoice_date,
            'next_renewal_date' => $request->next_renewal_date,
            'address_one' => $request->address_one,
            'address_two' => $request->address_two,
            'address_three' => $request->address_three,
            'postal' => $request->postal,
            'city' => $request->city,
            'state' => $request->state,
            'country' => $request->country,        
            'person_name' => $request->person_name,
            'person_nric' => $request->person_nric,
            'person_designation' => $request->person_designation,
            'person_email' => $request->person_email,
            'person_contact' => $request->person_contact,
        ]);

        return to_route('superadmin.company.view', $company->id)->with('successMessage', 'Successfully add new company');
    }

    public function view(Company $company)
    {
        $company->load(['client:id,name']);
        return view('superadmin.company.view', compact('company'));
    }

    public function edit(Company $company)
    {
        $clients = Client::where('is_active',1)
                ->where('is_subscribed',1)
                ->get();

        return view('superadmin.company.edit', compact('company', 'clients'));
    }

    public function update(UpdateRequest $request, Company $company)
    {
        $company->update([
            'client_id' => $request->client_id,
            'name' => $request->name,
            'former_name' => $request->former_name,
            'roc_one' => $request->roc_one,
            'roc_two' => $request->roc_two,
            'contact' => $request->contact,
            'fax' => $request->fax,
            'email' => $request->email,
            'time_zone' => $request->time_zone,
            'registration_date' => $request->registration_date,
            'invoice_date' => $request->invoice_date,
            'next_renewal_date' => $request->next_renewal_date,
            'address_one' => $request->address_one,
            'address_two' => $request->address_two,
            'address_three' => $request->address_three,
            'postal' => $request->postal,
            'city' => $request->city,
            'state' => $request->state,
            'country' => $request->country,        
            'person_name' => $request->person_name,
            'person_nric' => $request->person_nric,
            'person_designation' => $request->person_designation,
            'person_email' => $request->person_email,
            'person_contact' => $request->person_contact,
            'is_active' => $request->is_active,
        ]);

        return to_route('superadmin.company.view', $company)->with('successMessage', 'Successfully update company');
    }
}
