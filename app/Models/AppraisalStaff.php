<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppraisalStaff extends Model
{
    use HasFactory;

    protected $fillable = [
        'appraisal_setup_id',
        'user_id',
    ];

    public function appraisalSetup()
    {
        return $this->belongsTo(AppraisalSetup::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
