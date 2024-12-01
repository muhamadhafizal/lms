<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppraisalSetup extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'batch_id',
        'code',
        'description',
        'category',
        'review_start_date',
        'review_end_date',
        'rating_start_date',
        'rating_end_date',
        'is_active',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function batch()
    {
        return $this->belongsTo(BatchSetup::class);
    }

    public function appraisalParts()
    {
        return $this->hasMany(AppraisalPart::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'appraisal_staff', 'appraisal_setup_id', 'user_id');
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


