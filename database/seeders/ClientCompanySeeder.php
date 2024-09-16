<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Company;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClientCompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $client = Client::updateOrCreate(
            [
                'name' => 'CENTRALHR SDN.BHD.'
            ],
            [
                'registration_date' => now(),
                'invoice_date'  => now(),
                'next_renewal_date' => now(),
                'contact' => '07-2301100',
                'email' => 'admin@centralhr.com',
                'contact_person' => 'Sabrina',
                'contact_tel' => '012-9991100',
                'contact_email' => 'sabrina@centralhr.com',
            ]
        );

        $company = Company::updateOrCreate(
            [
                'name' => 'CentralHR'
            ],
            [
                'client_id' => $client->id,
                'former_name' => 'Sabrina',
                'roc_one' => '09',
                'roc_two' => '10',
                'contact' => '012-9991100',
                'email' => 'admin@centralhr.com',
                'registration_date' => now(),
                'next_renewal_date' => now(),
                'person_name' => 'Sabrina',
            ]
        );
    }
}
