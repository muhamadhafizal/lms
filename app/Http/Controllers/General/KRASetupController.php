<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use App\Http\Requests\General\Setups\KRA\StoreRequest;
use App\Http\Requests\General\Setups\KRA\UpdateRequest;
use App\Models\Client;
use App\Models\Company;
use App\Models\KRADescriptionSetup;
use App\Models\KRAHeaderSetup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KRASetupController extends Controller
{
    public function index(Request $request)
    {
        $kraSetups = KRAHeaderSetup::with([
            'company'
        ])
        ->roles(auth()->user()->getRoles()[0])
        ->search($request)
        ->latest()
        ->paginate(20)
        ->withQueryString();

        return view('general.setups.kra.index', compact('request', 'kraSetups'));
    }

    public function add()
    {
        $clients = Client::where('is_active', 1)
            ->where('is_subscribed', 1)
            ->get();

        $companies = Company::where('is_active', 1)
            ->get(); 

        return view('general.setups.kra.add', compact('clients', 'companies'));
    }

    public function store(StoreRequest $request)
    {
        //store information
        DB::transaction(function () use ($request) {
            $kraHeaderSetup = KRAHeaderSetup::create([
                'company_id' => $request->company,
                'header' => $request->header,
                'name' => $request->name,
                'is_copy' => $request->is_copy,
            ]);

            
            // Loop through the 'no', 'legend', and 'description' arrays
            for ($i = 0; $i < count($request->no); $i++) {
                KRADescriptionSetup::create([
                    'kra_header_id' => $kraHeaderSetup->id,
                    'no' => $request->no[$i],
                    'legend' => $request->legend[$i],
                    'description' => $request->description[$i],
                ]);
            }
        });

        return to_route( auth()->user()->getRoles()[0].'.setups.kra.index')->with('successMessage', 'Successfully add new KRA Setup');
    }

    public function edit(KRAHeaderSetup $kra)
    {
        $clients = Client::where('is_active', 1)
        ->where('is_subscribed', 1)
        ->get();

        $companies = Company::where('is_active', 1)
            ->get(); 
        
        $kra = $kra->load([
            'KRADescriptionSetups'
        ]);

        return view('general.setups.kra.edit', compact('kra', 'clients', 'companies'));
    }

    public function update(UpdateRequest $request, KRAHeaderSetup $kra)
    {
        DB::transaction(function () use ($request, $kra) {

            $kra->update([
                'company_id' => $request->company,
                'name' => $request->name,
                'is_copy' => $request->is_copy,
                'is_active' => $request->is_active,
            ]);

            // Loop through the form input arrays
            for ($i = 0; $i < count($request->kra_desc_setup_id); $i++) {
                // Find the existing KRADescriptionSetup by its ID
                $kraDescriptionSetup = KRADescriptionSetup::find($request->kra_desc_setup_id[$i]);
    
                // Update the fields for the current KRADescriptionSetup
                if ($kraDescriptionSetup) {
                    $kraDescriptionSetup->no = $request->no[$i];
                    $kraDescriptionSetup->legend = $request->legend[$i];
                    $kraDescriptionSetup->description = $request->description[$i];
                    $kraDescriptionSetup->save();
                }
            }

        });
        return to_route( auth()->user()->getRoles()[0].'.setups.kra.index')->with('successMessage', 'Successfully updated KRA Setup');
    }
}