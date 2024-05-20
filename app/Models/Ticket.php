<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Agence;
use App\Models\TypeTicket;

class Ticket extends Model
{
    use HasFactory;
    protected $casts = [
        'date_cloture' => 'datetime',
        'publie_le' => 'datetime',
    ];
    protected $fillable = [
        'type_ticket_id',
        'status',
        'num_declaration',
        'agence_id',
        'client',
        'code_client',
        'description',
        'resolution',
        'assigned_to',
        'date_cloture','cloture_creator','annuler_creater'
    ];
    public function agence()
    {
        return $this->belongsTo(Agence::class, 'agence_id');
    }
    public function type_ticket()
    {
        return $this->belongsTo(TypeTicket::class, 'type_ticket_id');
    }
    public function documents()
    {
        return $this->hasMany(Document::class, 'ticket_id');
    }
}
