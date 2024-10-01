<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeFeedbackSetup extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'code',
        'description',
        'is_active',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function questions()
    {
        return $this->hasMany(EmployeeFeedbackQuestion::class,'efs_id');
    }
}
