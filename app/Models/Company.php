<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'name',
        'former_name',
        'roc_one',
        'roc_two',
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
        'person_name',
        'person_nric',
        'person_designation',
        'person_email',
        'person_contact',
        'registration_date',
        'invoice_date',
        'next_renewal_date',
        'is_active',
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function scopeSearch(Builder $query): void
    {
        
    }
}
