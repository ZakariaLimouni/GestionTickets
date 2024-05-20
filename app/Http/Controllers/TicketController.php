<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;
use App\Models\Ticket;
use App\Models\User;
use App\Models\Agence;
use App\Models\TypeTicket;
use App\Models\TypeDocument;
use App\Models\Document;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Maatwebsite\Excel\Facades\Excel;

class TicketController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->hasRole('Chef-Agence')) {
            $tickets = Ticket::where('agence_id', $user->agence_id)->with('agence', 'type_ticket', 'documents')->paginate(10);
        } else {
            $tickets = Ticket::with('documents')->paginate(10);
        }

        return view('user.gestionTicket', compact('tickets'));
    }
    public function CreateTicket()
    {
        $role = Role::where('name', 'user-ServiceModification')->firstOrFail();

        $users = User::where('status', 'active')
            ->whereHas('roles', function ($query) use ($role) {
                $query->where('roles.id', $role->id);
            })
            ->get();

        $TypeTickets = TypeTicket::all();
        $agences = Agence::all();
        $user = Auth::user();
        if ($user->hasRole('Chef-Agence')) {

            $agences = Agence::where('id', $user->agence_id)->get();
        }

        return view('User.CreateTicket', compact('TypeTickets', 'users', 'agences'));
    }
    public function storeTicket(Request $request)
    {

        $request->validate([
            'type_ticket_id' => 'required',
            'status' => 'required',
            'num_declaration' => 'required',
            'agence_id' => 'required',
            'client' => 'required',
            'code_client' => 'required',
            'description' => 'required',
            'resolution' => 'required',
            'assigned_to' => 'required',
        ]);
        Ticket::create([
            'type_ticket_id' => $request->type_ticket_id,
            'status' => $request->status,
            'num_declaration' => $request->num_declaration,
            'agence_id' => $request->agence_id,
            'client' => $request->client,
            'code_client' => $request->code_client,
            'description' => $request->description,
            'resolution' => $request->resolution,
            'assigned_to' => $request->assigned_to,
        ]);
        return redirect()->route('user.gestionTicket');
    }
    public function ticketEdit(string $id)
    {

        $ticket = Ticket::findOrFail($id);
        $TypeTickets = TypeTicket::all();
        $agences = Agence::all();
        $TypeDocuments = TypeDocument::all();
        $role = Role::where('name', 'user')->firstOrFail();
        $users = User::where('status', 'active')
            ->whereHas('roles', function ($query) use ($role) {
                $query->where('roles.id', $role->id);
            })
            ->get();

        return view('user.modiferTicket', compact('ticket', 'TypeTickets', 'agences', 'users', 'TypeDocuments'));
    }
    public function updateDocTicket(Request $request, string $id)
    {
        $user = auth()->user();

        $ticket = Ticket::findOrFail($id);
        $TypeTickets = TypeTicket::all();
        $agences = Agence::all();
        $TypeDocuments = TypeDocument::all();
        $role = Role::where('name', 'user')->firstOrFail();
        $users = User::where('status', 'active')
            ->whereHas('roles', function ($query) use ($role) {
                $query->where('roles.id', $role->id);
            })
            ->get();

        if ($request->hasFile('document')) {
            $document = new Document();
            $document->document = $request->file('document')->store('public');
            $document->publie_le = now();
            $document->document_creator = $user->agence->agence . '/' . $user->name . ' ' . $user->Prenom;
            $document->type_document_id = $request->type_document_id; // Storing type_document_id
            $document->ticket()->associate($ticket);
            $document->save();
        }

        return view('user.modiferTicket', compact('ticket', 'TypeTickets', 'agences', 'users', 'TypeDocuments'));
    }

    public function deleteDocument($id)
    {
        $document = Document::findOrFail($id);
        $ticket = $document->ticket;
        $TypeTickets = TypeTicket::all();
        $agences = Agence::all();
        $TypeDocuments = TypeDocument::all();
        $role = Role::where('name', 'user')->firstOrFail();
        $users = User::where('status', 'active')
            ->whereHas('roles', function ($query) use ($role) {
                $query->where('roles.id', $role->id);
            })
            ->get();

        if ($document->document) {
            Storage::delete($document->document);
        }
        $document->delete();

        return view('user.modiferTicket', compact('ticket', 'TypeTickets', 'agences', 'users', 'TypeDocuments'));
    }



    public function updateTicket(Request $request, string $id)
    {
        $request->validate([
            'type_ticket_id' => 'required',
            'status' => 'required',
            'num_declaration' => 'required',
            'agence_id' => 'required',
            'client' => 'required',
            'code_client' => 'required',
            'description' => 'required',
            'resolution' => 'required',
            'assigned_to' => 'required',
        ]);


        $ticket = Ticket::findOrFail($id);

        $ticket->update([
            'type_ticket_id' => $request->type_ticket_id,
            'status' => $request->status,
            'num_declaration' => $request->num_declaration,
            'agence_id' => $request->agence_id,
            'client' => $request->client,
            'code_client' => $request->code_client,
            'description' => $request->description,
            'resolution' => $request->resolution,
            'assigned_to' => $request->assigned_to,
        ]);

        return redirect()->route('user.gestionTicket');
    }

    public function cloturerTicket($id)
    {
        $user = auth()->user();
        $ticket = Ticket::findOrFail($id);
        $ticket->status = 'Clôturer';
        $ticket->date_cloture = Carbon::now();
        $ticket->cloture_creator = $user->agence->agence . '/' . $user->name . ' ' . $user->Prenom;;
        $ticket->save();

        return redirect()->back()->with('success', 'Ticket cloturer avec success.');
    }
    public function showTicket($id)
    {
        $ticket = Ticket::with('agence', 'type_ticket')->findOrFail($id);
        return view('user.showTicket', compact('ticket'));
    }
    public function cancelTicket(Request $request)
    {
        $user = auth()->user();
        $ticket = Ticket::findOrFail($request->ticketId);
        $ticket->status = 'annuler';
        $ticket->annuler_creater = $user->agence->agence . '/' . $user->name . ' ' . $user->Prenom;
        $ticket->save();

        return response()->json(['message' => 'Ticket cancelled successfully']);
    }
    public function export(Request $request)
    {
        return Excel::download(new TicketsExport($request), 'tickets.xlsx');
    }
}
