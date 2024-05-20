<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'photo_profile',
        'Matricule',
        'name',
        'Prenom',
        'ville_id',
        'agence_id',
        'email',
        'Telephone',
        'userType',
        'password',
        'status',
        'last_login_at',
    ];
    protected $casts = [
        'created_at' => 'datetime',
    ];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function ville()
    {
        return $this->belongsTo(Ville::class, 'ville_id');
    }
    public function agence()
    {
        return $this->belongsTo(Agence::class , 'agence_id');
    }
    
}
