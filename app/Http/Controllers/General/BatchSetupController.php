<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use App\Http\Requests\General\Setups\Batch\StoreRequest;
use App\Http\Requests\General\Setups\Batch\UpdateRequest;
use App\Models\BatchSetup;
use App\Models\Client;
use App\Models\Company;
use Illuminate\Http\Request;

class BatchSetupController extends Controller
{
    public function index(Request $request)
    {
        $batchs = BatchSetup::with([
            'company'
        ])
        ->roles(auth()->user()->getRoles()[0])
        ->search($request)
        ->latest()
        ->paginate(20)
        ->withQueryString();

        return view('general.setups.batch.index', compact('batchs', 'request'));
    }

    public function add()
    {
        $clients = Client::where('is_active', 1)
            ->where('is_subscribed', 1)
            ->get();

        $companies = Company::where('is_active', 1)
            ->get(); 
        
        return view('general.setups.batch.add', compact('clients', 'companies'));
    }

    public function store(StoreRequest $request)
    {
        $batch = BatchSetup::create([
            'company_id' => $request->company,
            'code' => $request->code,
            'description' => $request->description,
        ]);

        return to_route( auth()->user()->getRoles()[0].'.setups.batch.index')->with('successMessage', 'Successfully add new batch');
    }

    public function view(BatchSetup $batch)
    {
        //return view('general.setups.batch.view', compact('batch'));
    }

    public function edit(BatchSetup $batch)
    {
        $clients = Client::where('is_active', 1)
        ->where('is_subscribed', 1)
        ->get();

        $companies = Company::where('is_active', 1)
            ->get(); 

        return view('general.setups.batch.edit', compact('batch', 'clients', 'companies'));
    }

    public function update(UpdateRequest $request, BatchSetup $batch)
    {
        $batch->update([
            'company_id' => $request->company,
            'code' => $request->code,
            'description' => $request->description,
            'active' => $request->active,
        ]);

        return redirect()->back()->with('successMessage', 'Successfully update batch');
    }
}
