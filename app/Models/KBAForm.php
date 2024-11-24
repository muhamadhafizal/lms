<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KBAForm extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'code',
        'description',
        'copy_staff_rating',
        'is_active',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function KBASets()
    {
        return $this->hasMany(KBASet::class, 'kba_form_id');
    }

    public function KBAHeaderSetups()
    {
        return $this->hasMany(KBAHeaderSetup::class, 'kba_form_id');
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
