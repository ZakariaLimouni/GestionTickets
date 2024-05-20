<table>
    <thead>
        <tr>
            <th>N°_Ticket</th>
            <th>Type</th>
            <th>Num_Declaration</th>
            <th>Client</th>
            <th>Code_Client</th>
            <th>Agence</th>
            <th>Description</th>
            <th>Résolution</th>
            <th>Status</th>
            <th>Assigné à</th>
            <th>Cree le</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($tickets as $ticket)
        <tr>
            <td>{{ $ticket->id }}</td>
            <td>{{ $ticket->type_ticket->libelle }}</td>
            <td>{{ $ticket->num_declaration }}</td>
            <td>{{ $ticket->client }}</td>
            <td>{{ $ticket->code_client }}</td>
            <td>{{ $ticket->agence->agence }}</td>
            <td>{{ $ticket->description }}</td>
            <td>{{ $ticket->resolution }}</td>
            <td>{{ $ticket->status }}</td>
            <td>
                @php
                    $user = App\Models\User::find($ticket->assigned_to);
                @endphp
                @if ($user)
                    {{ $user->agence->agence . '/' . $user->name . ' ' . $user->Prenom }}
                @else
                    No User Assigned
                @endif
            </td>
            <td>{{ $ticket->created_at }}</td>
        </tr>
        @endforeach
    </tbody>
</table>