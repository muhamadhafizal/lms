<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Employee extends Model
{
    use HasFactory, LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly([
            'user_id',
            'race_id',
            'religion_id',
            'nationality_id',
            'work_location_id',
            'cost_centre_id',
            'department_id',
            'section_id',
            'category_id',
            'job_grade_id',
            'business_unit_id',
            'qualification_id',
        ])
        ->useLogName('employee')
        ->setDescriptionForEvent(fn(string $eventName) => "This model has been {$eventName}");
    }

    protected $fillable = [
        'user_id',
        'security_group_id',
        'race_id',
        'religion_id',
        'nationality_id',
        'work_location_id',
        'cost_centre_id',
        'department_id',
        'section_id',
        'category_id',
        'job_grade_id',
        'business_unit_id',
        'qualification_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function securityGroup()
    {
        return $this->belongsTo(SecurityGroup::class);
    }

    public function supervisors()
    {
        return $this->hasMany(EmployeeSupervisor::class, 'employee_id');
    }

    public function race()
    {
        return $this->belongsTo(Race::class);
    }

    public function religion()
    {
        return $this->belongsTo(Religion::class);
    }

    public function nationality()
    {
        return $this->belongsTo(Nationality::class);
    }

    public function workLocation()
    {
        return $this->belongsTo(WorkLocation::class);
    }

    public function costCentre()
    {
        return $this->belongsTo(CostCentre::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function jobGrade()
    {
        return $this->belongsTo(JobGrade::class);
    }

    public function businessUnit()
    {
        return $this->belongsTo(BusinessUnit::class);
    }

    public function qualification()
    {
        return $this->belongsTo(Qualification::class);
    }
}
