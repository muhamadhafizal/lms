<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KRADescriptionSetup extends Model
{
    use HasFactory;

    protected $fillable = [
        'kra_header_id',
        'no',
        'legend',
        'description',
        'is_active',
    ];

    public function KRAHeaderSetup()
    {
        return $this->belongsTo(KRAHeaderSetup::class,'kra_header_id');
    }
}
