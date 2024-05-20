<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;
    protected $fillable = [
        'ticket_id',
        'document',
        'type_document_id',
        'publie_le',
        'document_creator',
    ];
    public function ticket()
    {
        return $this->belongsTo(Ticket::class,'ticket_id');
    }
    public function type_document()
    {
        return $this->belongsTo(TypeDocument::class, 'type_document_id');
    }
}
