<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ville extends Model
{
    use HasFactory;

    protected $fillable = [
        'codeVille',
        'ville',
        'status',
    ];
    public function agences()
    {
        return $this->hasMany(Ville::class, 'ville_id'); 
    }
    public function users()
    {
        return $this->hasMany(User::class, 'ville_id'); 
    }
}
