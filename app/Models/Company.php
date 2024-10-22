<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Company extends Model
{
    use HasFactory, LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly([
            'name',
            'former_name',
            'roc_one',
            'roc_two',
            'contact',
            'fax',
            'email',
            'person_name',
            'person_nric',
            'person_designation',
            'person_email',
            'person_contact',
            'registration_date',
            'invoice_date',
            'next_renewal_date',
            'is_active',
        ])
        ->useLogName('company')
        ->setDescriptionForEvent(fn(string $eventName) => "This model has been {$eventName}");
        // Chain fluent methods for configuration options
    }

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

    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function batchSetups()
    {
        return $this->hasMany(BatchSetup::class);
    }

    public function employeeFeedbackSetups()
    {
        return $this->hasMany(EmployeeFeedbackSetup::class);
    }

    public function supervisorFeedbackSetups()
    {
        return $this->hasMany(SupervisorFeedbackSetup::class);
    }

    public function KRAHeaderSetups()
    {
        return $this->hasMany(KRAHeaderSetup::class);
    }

    public function scopeSearch(Builder $query): void
    {
        
    }
}
