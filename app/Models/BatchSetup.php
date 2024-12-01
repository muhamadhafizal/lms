<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class BatchSetup extends Model
{
    use HasFactory, LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly([
            'code',
            'description',
            'active',
        ])
        ->useLogName('BatchSetup')
        ->setDescriptionForEvent(fn(string $eventName) => "This model has been {$eventName}");
        // Chain fluent methods for configuration options
    }

    protected $fillable = [
        'company_id',
        'code',
        'description',
        'active',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function appraisalSetups()
    {
        return $this->hasMany(AppraisalSetup::class);
    }

    public function scopeRoles($query, $roles)
    {
    
        if($roles == 'hradmin') {
            $query = $query->whereHas('company', function ($q) {
                $q->whereIn('id', auth()->user()->companies->pluck('id')->toArray());
            });
        }

        return $query;
    }


    public function scopeSearch(Builder $query): void
    {
        
    }
}
