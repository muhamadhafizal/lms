<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppraisalPart extends Model
{
    use HasFactory;

    protected $fillable = [
        'appraisal_setup_id',
        'part_id',
        'model',
        'title',
        'weightage',
        'is_active',
    ];

    public function appraisalSetup()
    {
        return $this->belongsTo(AppraisalSetup::class);
    }


}

