<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupervisorFeedbackQuestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'sfs_id',
        'question',
        'is_active',
    ];

    public function supervisorFeedbackSetup()
    {
        return $this->belongsTo(SupervisorFeedbackSetup::class,'sfs_id');
    }
}
