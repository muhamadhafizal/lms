<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class SecurityGroup extends Model
{
    use HasFactory, LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly([
            'name',
            'active',
        ])
        ->useLogName('securityGroup')
        ->setDescriptionForEvent(fn(string $eventName) => "This model has been {$eventName}");
        // Chain fluent methods for configuration options
    }

    protected $fillable = [
        'name',
        'active',
    ];

    public function employees(){
        return $this->hasMany(Employee::class);
    }

    public function users(){
        return $this->belongsToMany(User::class)->withTimestamps();
    }
}
