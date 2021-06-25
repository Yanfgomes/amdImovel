<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Immobiles;

class Financial extends Model
{
    use HasFactory, SoftDeletes;
    protected $dates = ['deleted_at'];
    
    protected $fillable = [
        'type_id',
        'immobile_id',
        'value',
        'status',
        'paid',
        'document'
    ];

    
    public function immobile()
    {
        //1 Imóvel está associado a 1 usuário
        return $this->belongsTo(Immobiles::class);
    }
}
