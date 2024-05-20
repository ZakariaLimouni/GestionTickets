<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agence extends Model
{
    use HasFactory;
    protected $fillable = [
        'codeAgence',
        'agence',
        'status',
        'ville_id'
    ];
    public function ville()
    {
        return $this->belongsTo(Ville::class, 'ville_id');
    }
    public function users()
    {
        return $this->hasMany(User::class, 'agence_id'); 
    }
}
