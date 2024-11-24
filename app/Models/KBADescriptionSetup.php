<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KBADescriptionSetup extends Model
{
    use HasFactory;

    protected $fillable = [
        'kba_header_id',
        'no',
        'legend',
        'description',
        'is_active',
    ];

    public function KBAHeader()
    {
        return $this->belongsTo(KBAHeaderSetup::class, 'kba_header_id');
    }
}
