<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class EmployeeSupervisor extends Model
{
    use HasFactory;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly([
            'employee_id',
            'supervisor_id',
            'level',
            'is_archived',
        ])
        ->useLogName('employee_supervisor')
        ->setDescriptionForEvent(fn(string $eventName) => "This model has been {$eventName}");
    }

    protected $fillable = [
        'employee_id',
        'supervisor_id',
        'level',
        'is_archived',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    public function supervisor()
    {
        return $this->belongsTo(Employee::class, 'supervisor_id');
    }
}
