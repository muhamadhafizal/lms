<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KBASet extends Model
{
    use HasFactory;

    protected $fillable = [
        'kba_form_id',
        'name',
        'weightage',
        'parent_id',
        'is_active',
    ];

    public function KBAForm()
    {
        return $this->belongsTo(KBAForm::class, 'kba_form_id');
    }
    
}
