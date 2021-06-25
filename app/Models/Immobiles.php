<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use App\Models\Ufs;
use App\Models\Financial;

class Immobiles extends Model
{
    use HasFactory, SoftDeletes;
    protected $dates = ['deleted_at'];
    
    protected $fillable = [
        'user_id',
        'lessee_id',
        'status',
        'cep',
        'uf_id',
        'city',
        'district',
        'street',
        'number',
        'complement',
        'rent',
    ];

    
    public function user()
    {
        //1 Imóvel está associado a 1 usuário
        return $this->belongsTo(User::class);
    }

    public function uf()
    {
        //1 imóvel está associado a 1 uf
        return $this->belongsTo(Ufs::class);
    }
    
    public function lessee()
    {
        //1 Imóvel está associado a 1 locatário
        return $this->belongsTo(User::class, 'lessee_id');
    }

    public function financial(){
        //1 imóvel está associado a várias faturas
        return $this->hasMany(Financial::class, 'immobile_id');
    }
}
