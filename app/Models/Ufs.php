<?php

namespace App\Models;
use App\Models\Immobiles;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ufs extends Model
{
    use HasFactory;

    protected $table = 'list_uf';

    protected $fillable = [
        'uf',
        'name',
    ];
    
    public function immobiles()
    {
        //1 uf está associado a vários imóveis
        return $this->hasMany(Immobiles::class);
    }
}
