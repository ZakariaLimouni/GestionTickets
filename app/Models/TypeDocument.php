<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeDocument extends Model
{
    use HasFactory;
    protected $fillable = [
        'libelle',
        'status',
    ];
    public function setLibelleAttribute($value)
    {
        $this->attributes['libelle'] = strtoupper($value);
    }
}
