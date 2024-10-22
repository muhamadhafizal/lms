<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KRAHeaderSetup extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'header',
        'name',
        'is_active',
        'is_copy',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function KRADescriptionSetups()
    {
        return $this->hasMany(KRADescriptionSetup::class,'kra_header_id');
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
