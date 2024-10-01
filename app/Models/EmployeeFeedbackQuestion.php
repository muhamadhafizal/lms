<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeFeedbackQuestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'efs_id',
        'question',
        'is_active',
    ];

    public function employeeFeedbackSetup()
    {
        return $this->belongsTo(EmployeeFeedbackSetup::class,'efs_id');
    }
}
