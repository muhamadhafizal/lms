<?php

namespace App\Http\Controllers\superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Superadmin\Client\StoreRequest;
use App\Http\Requests\Superadmin\Client\UpdateRequest;
use App\Models\Client;

class ClientController extends Controller
{
    public function index(Request $request)
    {
        $clients = Client::withCount('companies')
            ->search($request)
            ->latest()
            ->paginate(20)
            ->withQueryString();

        return view('superadmin.client.index', compact('clients', 'request'));
    }

    public function add()
    {
        return view('superadmin.client.add');
    }

    public function store(StoreRequest $request)
    {
        $client = Client::create([
            'name' => $request->name,
            'registration_date' => $request->registration_date,
            'invoice_date' => $request->invoice_date,
            'next_renewal_date' => $request->next_renewal_date,
            'contact' => $request->contact,
            'fax' => $request->fax,
            'email' => $request->email,
            'address_one' => $request->address_one,
            'address_two' => $request->address_two,
            'address_three' => $request->address_three,
            'postal' => $request->postal,
            'city' => $request->city,
            'state' => $request->state,
            'country' => $request->country,
            'time_zone' => $request->time_zone,
            'contact_person' => $request->contact_person,
            'contact_tel' => $request->contact_tel,
            'contact_email' => $request->contact_email,
            'logo_file_name' => $request->logo_file_name,
        ]);

        return to_route('superadmin.client.view', $client->id)->with('successMessage', 'Successfully add new client');
    }

    public function view(Client $client)
    {
        return view('superadmin.client.view', compact('client'));
    }

    public function edit(Client $client)
    {
        return view('superadmin.client.edit', compact('client'));
    }

    public function update(UpdateRequest $request, Client $client)
    {
        $client->update([
            'name' => $request->name,
            'registration_date' => $request->registration_date,
            'invoice_date' => $request->invoice_date,
            'next_renewal_date' => $request->next_renewal_date,
            'contact' => $request->contact,
            'fax' => $request->fax,
            'email' => $request->email,
            'address_one' => $request->address_one,
            'address_two' => $request->address_two,
            'address_three' => $request->address_three,
            'postal' => $request->postal,
            'city' => $request->city,
            'state' => $request->state,
            'country' => $request->country,
            'time_zone' => $request->time_zone,
            'contact_person' => $request->contact_person,
            'contact_tel' => $request->contact_tel,
            'contact_email' => $request->contact_email,
            'logo_file_name' => $request->logo_file_name,
            'is_active' => $request->is_active,
            'is_subscribed' => $request->is_subscribed,
        ]);

        return to_route('superadmin.client.view', $client)->with('successMessage', 'Successfully update client');
    }
}
