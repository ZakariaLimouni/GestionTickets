<?php

namespace App\Exports;

use App\Models\Ticket;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class TicketsExport implements FromView
{
    protected $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function view(): View
    {
        $query = Ticket::query();

        if ($this->request->id) {
            $query->where('id', 'like', '%' . $this->request->id . '%');
        }
        if ($this->request->type) {
            $query->whereHas('type_ticket', function ($q) {
                $q->where('libelle', 'like', '%' . $this->request->type . '%');
            });
        }
        if ($this->request->num_declaration) {
            $query->where('num_declaration', 'like', '%' . $this->request->num_declaration . '%');
        }
        if ($this->request->client) {
            $query->where('client', 'like', '%' . $this->request->client . '%');
        }
        if ($this->request->agence) {
            $query->whereHas('agence', function ($q) {
                $q->where('agence', 'like', '%' . $this->request->agence . '%');
            });
        }
        if ($this->request->status) {
            $query->where('status', 'like', '%' . $this->request->status . '%');
        }
        if ($this->request->startDate) {
            $query->whereDate('created_at', '>=', $this->request->startDate);
        }
        if ($this->request->endDate) {
            $query->whereDate('created_at', '<=', $this->request->endDate);
        }

        $tickets = $query->get();

        return view('exports.tickets', [
            'tickets' => $tickets
        ]);
    }
}
