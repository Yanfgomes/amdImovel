<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Immobiles;
use App\Models\ListStatus;
use App\Models\ListType;

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
        'cycle',
        'due',
        'document'
    ];

    
    public function immobile()
    {
        //1 Fatura está associado a 1 imóvel
        return $this->belongsTo(Immobiles::class);
    }

    
    public function status()
    {
        //1 Fatura está associado a 1 status
        return $this->belongsTo(ListStatus::class);
    }

    
    public function type()
    {
        //1 Fatura está associado a 1 status
        return $this->belongsTo(ListType::class);
    }
}
