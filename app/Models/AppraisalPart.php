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

    //check model example KRA is model KRAHEADERSETUP
    //then query part_id

    //check model example KBA is model KBAFORM
    //then query part_id

    //if model extrea not model
    public function relatedModel()
    {
        // Define a mapping of model identifiers to actual model classes
        $models = [
            'KRA' => \App\Models\KRAHeaderSetup::class,
            'KBA' => \App\Models\KBAForm::class,
        ];

        // Check if the model exists in the mapping
        if (isset($models[$this->model])) {
            return $models[$this->model]::find($this->part_id);
        }

        // Return null if no matching model is found
        return null;
    }


}

