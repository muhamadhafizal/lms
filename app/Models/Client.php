<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Client extends Model
{
    use HasFactory, LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly([
            'name',
            'registration_date',
            'invoice_date',
            'next_renewal_date',
            'is_active',
            'contact',
            'fax',
            'email',
            'contact_person',
            'contact_tel',
            'contact_email',
            'is_subscribed',
        ])
        ->useLogName('client')
        ->setDescriptionForEvent(fn(string $eventName) => "This model has been {$eventName}");
        // Chain fluent methods for configuration options
    }

    protected $fillable = [
        'name',
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

    public function scopeSearch(Builder $query): void
    {
        
    }


}

