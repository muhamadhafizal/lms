<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use App\Http\Requests\General\Setups\KBA\Form\StoreRequest;
use App\Http\Requests\General\Setups\KBA\Form\UpdateRequest;
use App\Models\Client;
use App\Models\Company;
use App\Models\KBADescriptionSetup;
use App\Models\KBAForm;
use App\Models\KBAHeaderSetup;
use App\Models\KBASet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KBASetupController extends Controller
{
    public function index(Request $request)
    {
        $kbaForms = KBAForm::with([
            'company'
        ])
        ->roles(auth()->user()->getRoles()[0])
        ->search($request)
        ->latest()
        ->paginate(20)
        ->withQueryString();

        return view('general.setups.kba.index', compact('request', 'kbaForms'));
    }

    public function formAdd()
    {
        $clients = Client::where('is_active', 1)
            ->where('is_subscribed', 1)
            ->get();

        $companies = Company::where('is_active', 1)
            ->get(); 
        
        return view('general.setups.kba.form-add', compact('clients', 'companies'));
    }

    public function formStore(StoreRequest $request)
    {
        DB::transaction(function () use ($request) {
            $kbaForm = KBAForm::create([
                'company_id' => $request->company,
                'code' => $request->code,
                'description' => $request->form_description,
                'copy_staff_rating' => $request->is_copy,
            ]);

            //KBA HEADER
            $kbaHeader = KBAHeaderSetup::create([
                'kba_form_id' => $kbaForm->id,
                'header' => $request->header,
            ]);

            //KBA DESCRIPTION
            // Loop through the 'no', 'legend', and 'description' arrays
            for ($i = 0; $i < count($request->no); $i++) {
                KBADescriptionSetup::create([
                    'kba_header_id' => $kbaHeader->id,
                    'no' => $request->no[$i],
                    'legend' => $request->legend[$i],
                    'description' => $request->description[$i],
                ]);
            }
        });

        return to_route( auth()->user()->getRoles()[0].'.setups.kba.index')->with('successMessage', 'Successfully add new kba');
    }

    public function formEdit(KBAForm $kbaForm)
    {
        $clients = Client::where('is_active', 1)
        ->where('is_subscribed', 1)
        ->get();

        $companies = Company::where('is_active', 1)
            ->get();
        
        $kbaHeader = KBAHeaderSetup::with('KBADescriptionSetups')
                ->where('kba_form_id',$kbaForm->id)
                ->first();

        return view('general.setups.kba.form-edit', compact('kbaForm', 'clients', 'companies','kbaHeader'));
    }

    public function formUpdate(UpdateRequest $request, KBAForm $kbaForm)
    {
        $kbaForm->update([
            'company_id' => $request->company,
            'code' => $request->code,
            'description' => $request->form_description,
            'copy_staff_rating' => $request->is_copy,
            'is_active' => $request->active,
        ]);

        $kbaForm->KBAHeaderSetups[0]->update([
            'header' => $request->header,
        ]);

        // Loop through the form input arrays
        for ($i = 0; $i < count($request->kba_desc_setup_id); $i++) {
            // Find the existing KRADescriptionSetup by its ID
            $kbaDescriptionSetup = KBADescriptionSetup::find($request->kba_desc_setup_id[$i]);
    
                // Update the fields for the current KRADescriptionSetup
                if ($kbaDescriptionSetup) {
                    $kbaDescriptionSetup->no = $request->no[$i];
                    $kbaDescriptionSetup->legend = $request->legend[$i];
                    $kbaDescriptionSetup->description = $request->description[$i];
                    $kbaDescriptionSetup->save();
                }
        }



        return redirect()->back()->with('successMessage', 'Successfully update KBA Form');
    }

    public function formView(KBAForm $kbaForm)
    {
        $kbas = KBASet::where('kba_form_id', $kbaForm->id)
        ->get()
        ->toArray();

        // Format KBAs into a hierarchical structure
        $formattedKbas = $this->formatKBAList($kbas);
        $totalWeightage = $this->calculateTotalWeightage($formattedKbas);

        $i = 1;
        return view('general.setups.kba.form-view', compact('kbaForm','formattedKbas','i','totalWeightage'));
    }

    public function setAdd(KBAForm $kbaForm)
    {
        return view('general.setups.kba.set-add', compact('kbaForm'));
    }

    public function setStore(Request $request, KBAForm $kbaForm)
    {
         // Validate the data
        $validated = $request->validate([
            'kbas' => 'required|array',
            'kbas.*.description' => 'required|string|max:255',
            'kbas.*.sub_kbas' => 'nullable|array',
            'kbas.*.sub_kbas.*.description' => 'required_with:kbas.*.sub_kbas|string|max:255',
            'kbas.*.sub_kbas.*.weight' => 'required_with:kbas.*.sub_kbas|numeric|min:0|max:100',
        ]);

        $kbas = $request->input('kbas');

        // Iterate over KBAs and store them
        foreach ($kbas as $kba) {
            // Store the main KBA
            $mainKba = KBASet::create([
                'kba_form_id' => $kbaForm->id,
                'name' => $kba['description'],
                'weightage' => $kba['weight'] ?? 0,
                'parent_id' => null, // Main KBA has no parent
            ]);

            // Check if sub-KBAs exist
            if (isset($kba['sub_kbas']) && is_array($kba['sub_kbas'])) {
                foreach ($kba['sub_kbas'] as $subKba) {
                    // Store the sub-KBA with parent ID
                    KBASet::create([
                        'kba_form_id' => $kbaForm->id,
                        'name' => $subKba['description'],
                        'weightage' => $subKba['weight'],
                        'parent_id' => $mainKba->id, // Reference the parent KBA
                    ]);
                }
            }
        }

        return to_route( auth()->user()->getRoles()[0].'.setups.kba.form-view', $kbaForm)->with('successMessage', 'Successfully add new kba');
    }

    public function setEdit(KBAForm $kbaForm)
    {
        $kbas = KBASet::where('kba_form_id', $kbaForm->id)
        ->get()
        ->toArray();

        // Format KBAs into a hierarchical structure
        $formattedKbas = $this->formatKBAList($kbas);

        return view('general.setups.kba.set-edit', compact('kbaForm', 'formattedKbas'));
    }

    public function setUpdate(Request $request,KBAForm $kbaForm)
    {
        // Validate the input
        $validatedData = $request->validate([
            'kbas' => 'required|array',
            'kbas.*.name' => 'required|string|max:255',
            'kbas.*.weight' => 'nullable|numeric|min:0|max:100',
        ]);

        // Process the KBAs
        $totalWeight = 0;
        foreach ($request->input('kbas') as $kbaData) {
            // Ensure the weightage is valid
            if (isset($kbaData['weight'])) {
                $totalWeight += $kbaData['weight'];
            }

            // Find the KBA and update its name and weight
            $kba = KBASet::findOrFail($kbaData['id']); // Ensure 'id' is passed in the request
            $kba->update([
                'name' => $kbaData['name'],
                'weightage' => $kbaData['weight'] ?? null,
            ]);
        }

        // Validate total weightage
        if ($totalWeight > 100) {
            return back()->withErrors(['errorMessage' => 'Total weightage cannot exceed 100%.']);
        }

        return redirect()->route(auth()->user()->getRoles()[0] . '.setups.kba.form-view', $kbaForm)
            ->with('successMessage', 'KBA updated successfully.');
    }

    public function setCopy(Request $request,KBAForm $kbaForm)
    {

        $formattedKbas = null;
        $totalWeightage = 0;

        //list setKBAForm
        $listCopyKbaForms = KBAForm::where('company_id',$kbaForm->company_id)
                            ->where('id','!=',$kbaForm->id)
                            ->whereHas('kbaSets', function ($query) {
                                $query->whereNotNull('id'); // Assuming 'id' is a required field in kbaSets
                            })
                            ->get();

        if($request->input('copy_kba_id') != null) {
            
            $kbas = KBASet::where('kba_form_id', $request->input('copy_kba_id'))
            ->get()
            ->toArray();

            // Format KBAs into a hierarchical structure
            $formattedKbas = $this->formatKBAList($kbas);
            $totalWeightage = $this->calculateTotalWeightage($formattedKbas);
        }
        $i = 1;
        $copyKbaId = $request->input('copy_kba_id');

        return view('general.setups.kba.set-copy', compact('kbaForm','listCopyKbaForms','formattedKbas','totalWeightage','i','copyKbaId'));
    }

    public function setCopyStore(Request $request,KBAForm $kbaForm)
    {
       // Get the KBA sets from the source KBA form
        $copySetKbaForms = KBASet::where('kba_form_id', $request->input('copy_kba_id'))
        ->get()
        ->toArray();

        // Initialize an array to map old IDs to new IDs for maintaining parent-child relationships
        $idMapping = [];

        // Iterate over the KBA sets to copy them
        foreach ($copySetKbaForms as $kba) {
        // Store the main KBA
        $newKba = KBASet::create([
            'kba_form_id' => $kbaForm->id, // New KBA form ID
            'name' => $kba['name'],        // Copy name
            'weightage' => $kba['weightage'], // Copy weightage
            'parent_id' => $kba['parent_id'] ? $idMapping[$kba['parent_id']] : null, // Map parent ID
            'is_active' => $kba['is_active'], // Copy active status
        ]);

        // Save the new ID in the mapping array
        $idMapping[$kba['id']] = $newKba->id;
        }

        return to_route( auth()->user()->getRoles()[0].'.setups.kba.form-view', $kbaForm)->with('successMessage', 'Successfully add new kba');

    }

    private function formatKBAList(array $kbas, $parentId = null)
    {
        $tree = [];
        foreach ($kbas as $kba) {
            if ($kba['parent_id'] == $parentId) {
                // Recursively find children
                $children = $this->formatKBAList($kbas, $kba['id']);
                if (!empty($children)) {
                    $kba['children'] = $children;
                }
                $tree[] = $kba;
            }
        }
        return $tree;
    }

    private function calculateTotalWeightage(array $tree)
    {
        $totalWeightage = 0;

        foreach ($tree as $node) {
            // Add the current node's weightage if it exists
            $totalWeightage += $node['weightage'] ?? 0;

            // If the node has children, recursively calculate their weightage
            if (isset($node['children'])) {
                $totalWeightage += $this->calculateTotalWeightage($node['children']);
            }
        }

        return $totalWeightage;
    }

}
