<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'registration_date',
        'invoice_date',
        'next_renewal_date',
        'is_active',
        'contact',
        'fax',
        'email',
        'address_one',
        'address_two',
        'address_three',
        'postal',
        'city',
        'state',
        'country',
        'time_zone',
        'contact_person',
        'contact_tel',
        'contact_email',
        'logo_file_name',
        'is_subscribed',
    ];

    public function companies(): HasMany
    {
        return $this->hasMany(Company::class);
    }


}

