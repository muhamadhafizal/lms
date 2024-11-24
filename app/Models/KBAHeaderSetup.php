<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KBAHeaderSetup extends Model
{
    use HasFactory;

    protected $fillable = [
        'kba_form_id',
        'header',
        'name',
        'is_copy',
        'is_active',
    ];

    public function KBAForm()
    {
        return $this->belongsTo(KBAForm::class, 'kba_form_id');
    }

    public function KBADescriptionSetups()
    {
        return $this->hasMany(KBADescriptionSetup::class,'kba_header_id');
    }
}
