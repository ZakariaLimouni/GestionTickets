<x-app-layout>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-black-800 dark:text-BLACK-200 leading-tight"
            style="display: inline-block; border-bottom: 3px solid #006622; padding-left: 8px;padding-right: 8px;">
            {{ __('List des Tickets') }}
        </h2>
    </x-slot>
    <div class="py-12">

        <div class="bg-white dark:bg-white-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-white-900 dark:text-white-100">

                <style>
                    body {
                        font-family: Arial, sans-serif;
                        background-color: #f5f5f5;
                        color: #333;
                        margin: 0;
                        padding: 0;

                    }

                    .container {
                        max-width: 1200px;
                        margin: 0 auto;
                        padding: 0px;
                    }

                    .button-container {
                        display: flex;
                        gap: 5px;
                    }

                    .button-container button,
                    .button-container a {
                        padding: 5px 10px;
                        border-radius: 5px;
                        cursor: pointer;
                        transition: background-color 0.3s ease;
                    }

                    .button-container button:hover,
                    .button-container a:hover {
                        background-color: #005a55;
                        color: white;
                    }

                    table {
                        width: 100%;
                        border-collapse: collapse;
                        font-size: 0.9rem;
                    }

                    /* Style pour les cellules */
                    table td,
                    table th {
                        border: 1px solid #ddd;
                        padding: 8px;
                        text-align: left;


                    }

                    table th {
                        text-align: center;
                        background-color: #E1F1DF;
                    }

                    /* Style pour les boutons dans les cellules */
                    .button-container button,
                    .button-container a {
                        padding: 4px 8px;
                        border-radius: 5px;
                        cursor: pointer;
                        color: #fff;
                        border: none;
                        transition: background-color 0.3s ease;
                        margin-right: 5px
                    }

                    .button-container button:hover,
                    .button-container a:hover {
                        background-color: #0056b3;
                    }

                    table tbody {
                        font-size: 0.9rem;
                        /* Taille de police réduite */
                    }

                    table tbody td {

                        /* Texte en gras */
                    }

                    /* Alignement avec le champ de recherche */
                    .heading-container {
                        display: flex;
                        align-items: baseline;
                        justify-content: space-between;
                    }

                    .search-inputs input {
                        width: 50px;
                    }

                    .annuler-ticket {
                        background-color: #ff8080 !important;
                    }

                
                    .list-group-item {
            background-color: #fff;
            color: #000;
        }
        .list-group-item a {
            color: #007bff;
            text-decoration: none;
        }
        .list-group-item a:hover {
            color: #f3f3f3;
            text-decoration: underline;
        }
                </style>

                <div class="container mx-auto px-4"style="margin-left: 120px">

                    <div class="search-inputs flex" style="margin-right: 50px">

                        <label for=""class="font-semibold text-sm py-1 px-2 rounded">N°_Ticket:</label>
                        <input type="text" id="idInput" onkeyup="filterTable()" placeholder="N° Ticket..."
                            style="width: 300px;" class="border border-gray-300 rounded-md px-1 py-1 mr-1">

                        <label for=""class="font-semibold text-sm py-1 px-2 rounded"
                            style="margin-left: 10px">Type:</label>
                        <select id="typeInput"
                            style="width: 250px;"class="border border-gray-300 rounded-md px-1 py-1 mr-1"
                            onchange="filterTable()">
                            <option value="">Tous(...)</option>
                            @php
                                $uniqueTypes = $tickets->unique('type_ticket.libelle');
                            @endphp
                            @foreach ($uniqueTypes as $ticket)
                                <option>{{ $ticket->type_ticket->libelle }}</option>
                            @endforeach
                        </select>


                        <label for="" class="font-semibold text-sm py-1 px-2 rounded"
                            style="margin-left: 0px">Num_Declaration:</label>
                        <input type="text" id="num_declarationInput" onkeyup="filterTable()"
                            placeholder="Num_Declaration..." style="width: 150px;"
                            class="border border-gray-300 rounded-md px-1 py-1 mr-1">

                        <label for="" class="font-semibold text-sm py-1 px-2 rounded"
                            style="margin-left: 10px">Client:</label>
                        <input type="text" id="clientInput" onkeyup="filterTable()" placeholder="Client..."
                            style="width: 250px;" class="border border-gray-300 rounded-md px-1 py-1 mr-1">

                    </div>
                    <div class="search-inputs flex" style="margin-right: 50px; margin-top: 10px;">
                        <div>
                            <label for=""class="font-semibold text-sm py-1 px-2 rounded"
                                style="margin-left: 50px;">Agence:</label>
                            <select id="agenceInput"
                                style="width: 200px;"class="border border-gray-300 rounded-md px-1 py-1 mr-1"
                                onchange="filterTable()">
                                <option value="">Tous(...)</option>
                                @php
                                    $uniqueAgences = $tickets->unique('agence.agence');
                                @endphp
                                @foreach ($uniqueAgences as $ticket)
                                    <option>{{ $ticket->agence->agence }}</option>
                                @endforeach
                            </select>
                            <label for=""class="font-semibold text-sm py-1 px-2 rounded"
                                style="margin-left: 40px">Status:</label>
                            <select id="statusInput"
                                style="width: 200px;"class="border border-gray-300 rounded-md px-1 py-1 mr-1"
                                onchange="filterTable()">
                                <option value="">Tous(...)</option>
                                @php
                                    $uniqueStatus = $tickets->unique('status');
                                @endphp
                                @foreach ($uniqueStatus as $ticket)
                                    <option>{{ $ticket->status }}</option>
                                @endforeach
                            </select>
                            <label for="" class="font-semibold text-sm py-1 px-2 rounded">Du:</label>
                            <input type="text" id="startDateInput" placeholder="Début..."
                                class="border border-gray-300 rounded-md px-1 py-1 mr-1" style="width: 150px;"
                                data-input>



                            <label for=""
                                class="font-semibold text-sm py-1 px-2 rounded"style="margin-left: 10px">Au:</label>
                            <input type="text" id="endDateInput" placeholder="Fin..."
                                class="border border-gray-300 rounded-md px-1 py-1 mr-1" style="width: 150px;"
                                data-input>
                        </div>
                    </div>
                    <div style="margin-left:1100px;">
                        <button onclick="location.reload()"
                            class="bg-black-300 text-black-800 py-1 px-4 rounded-md mr-2 rounded"
                            style="background-color:rgb(224, 197, 15);top:100px;background-color 0.3s;"
                            onmouseover="this.style.backgroundColor='rgb(190, 167, 15) ';"
                            onmouseout="this.style.backgroundColor='rgb(224, 197, 15)';">
                            Réinitialiser
                        </button>

                    </div><br>
                </div>
                <form action="{{ route('exportTickets') }}" method="GET" id="exportForm">
                    <input type="hidden" name="id" id="export_id">
                    <input type="hidden" name="type" id="export_type">
                    <input type="hidden" name="num_declaration" id="export_num_declaration">
                    <input type="hidden" name="client" id="export_client">
                    <input type="hidden" name="agence" id="export_agence">
                    <input type="hidden" name="status" id="export_status">
                    <input type="hidden" name="startDate" id="export_startDate">
                    <input type="hidden" name="endDate" id="export_endDate">
                    <button type="button" onclick="exportTickets()" style="color:white;background-color:green"
                        class="bg-green-500 text-white py-2 px-4 rounded-md shadow-md hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-400 focus:ring-opacity-75">
                        Exporter
                    </button>
                </form>
                <br>
                <table id="ticketTable" class="w-full">
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
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tickets as $ticket)
                            @if ($ticket->status === 'annuler')
                                <tr class="{{ $ticket->status === 'annuler' ? 'annuler-ticket' : '' }}">
                                    <td>{{ $ticket->id }}</td>
                                    <td>{{ $ticket->type_ticket->libelle }}</td>
                                    <td>{{ $ticket->num_declaration }}</td>
                                    <td>{{ $ticket->client }}</td>
                                    <td>{{ $ticket->code_client }}</td>
                                    <td>{{ $ticket->agence->agence }}</td>
                                    <td>{{ $ticket->description }}</td>
                                    <td>{{ $ticket->resolution }}</td>
                                    @if ($ticket->status === 'en_instance')
                                        <td> <strong>en_instance</strong></td>
                                    @else
                                        <td><strong>{{ $ticket->status }}</strong></td>
                                    @endif

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
                                    <td>Ce ticket a été annulé par : <strong>{{ $ticket->annuler_creater }}</strong>
                                    </td>
                                </tr>
                            @else
                                <tr>
                                    <td>{{ $ticket->id }}</td>
                                    <td>{{ $ticket->type_ticket->libelle }}</td>
                                    <td>{{ $ticket->num_declaration }}</td>
                                    <td>{{ $ticket->client }}</td>
                                    <td>{{ $ticket->code_client }}</td>
                                    <td>{{ $ticket->agence->agence }}</td>
                                    <td>{{ $ticket->description }}</td>
                                    <td>{{ $ticket->resolution }}</td>
                                    @if ($ticket->status === 'en_instance')
                                        <td><strong>en_instance</strong></td>
                                    @else
                                        <td><strong>{{ $ticket->status }}</strong></td>
                                    @endif

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
                                    <td style="width: 100px">{{ $ticket->created_at }}</td>
                                    <td class="table-buttons">
                                        <div class="button-container">
                                            @if ($ticket->status === 'en_instance')
                                            @can('show document')
                                            @if ($ticket->documents->count() > 0)
                                            <a href="#documentsModal-{{ $ticket->id }}" data-toggle="modal"
                                                style="background-color: #006bb3; color: white; transition: background-color 0.3s;"
                                                onmouseover="this.style.backgroundColor='#005c99';"
                                                onmouseout="this.style.backgroundColor='#006bb3';"
                                                class="button-style">
                                                 <i class="fa fa-paperclip"></i>
                                             </a>
                                             <div class="modal fade" id="documentsModal-{{ $ticket->id }}" tabindex="-1" role="dialog" aria-labelledby="documentsModalLabel-{{ $ticket->id }}" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="documentsModalLabel-{{ $ticket->id }}">Documents</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <ul class="list-group">
                                                                @foreach($ticket->documents as $document)
                                                                    <li class="list-group-item">
                                                                        <a href="{{ Storage::url($document->document) }}" target="_blank">
                                                                            {{ $document->publie_le ?? 'Document' }}
                                                                        </a>
                                                                    </li>
                                                                @endforeach
                                                     </ul>
                                                  </div>
                                               </div>
                                            </div>
                                         </div>
                                            @else
                                                <a href="#"
                                                    style="background-color: transparent; color: transparent; pointer-events: none; width:28px"
                                                    class="button-style">
                                                    <i class="fa"></i>
                                                </a>
                                            @endif
                                        @endcan
                                                @can('view ticket')
                                                    <a href="{{ route('user.showTicket', $ticket->id) }}"
                                                        style="background-color: #20595D;background-color 0.3s;
                                                        "onmouseover="this.style.backgroundColor='#3b767c ';"
                                                        onmouseout="this.style.backgroundColor='#20595D';"
                                                        class="button-style">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                @endcan
                                                @can('modifer ticket')
                                                    <a href="{{ route('user.editTicket', $ticket->id) }}"
                                                        style="background-color: #b35900;transition: background-color 0.3s;
                                                        "onmouseover="this.style.backgroundColor='#994d00';"
                                                        onmouseout="this.style.backgroundColor='#b35900 ';"
                                                        class="button-style">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>
                                                @endcan
                                                @can('cloturer ticket')
                                                    <form action="{{ route('user.cloturerTicket', $ticket->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        <button type="submit" class="block-button"
                                                            style="background-color: #00b33c; background-color 0.3s;
                                                            "onmouseover="this.style.backgroundColor='#009933 ';"
                                                            onmouseout="this.style.backgroundColor='#00b33c';"
                                                            class="button-style"> <i class="fa fa-check"></i></button>
                                                    </form>
                                                @endcan
                                                @can('annuler ticket')
                                                    <button onclick="annulerTicket({{ $ticket->id }})"
                                                        style="background-color: #E20D0D; transition: background-color 0.3s;
                                                "
                                                        onmouseover="this.style.backgroundColor='#cc0000 ';"
                                                        onmouseout="this.style.backgroundColor='#E20D0D';"
                                                        class="button-style">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                @endcan
                                                <script>
                                                    function annulerTicket(ticketId) {
                                                        if (confirm('Êtes-vous sûr de vouloir annuler ce Ticket?')) {
                                                            axios.post('/cancel-ticket', {
                                                                    ticketId: ticketId
                                                                })
                                                                .then(function(response) {
                                                                    window.location.reload();
                                                                })
                                                                .catch(function(error) {
                                                                    console.error('Error cancelling ticket:', error);
                                                                });
                                                        }
                                                    }
                                                </script>
                                            @elseif($ticket->status === 'Clôturer')
                                                @can('show document')
                                                    @if ($ticket->documents->count() > 0)
                                                    <a href="#documentsModal-{{ $ticket->id }}" data-toggle="modal"
                                                        style="background-color: #006bb3; color: white; transition: background-color 0.3s;"
                                                        onmouseover="this.style.backgroundColor='#005c99';"
                                                        onmouseout="this.style.backgroundColor='#006bb3';"
                                                        class="button-style">
                                                         <i class="fa fa-paperclip"></i>
                                                     </a>
                                                     <div class="modal fade" id="documentsModal-{{ $ticket->id }}" tabindex="-1" role="dialog" aria-labelledby="documentsModalLabel-{{ $ticket->id }}" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="documentsModalLabel-{{ $ticket->id }}">Documents</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <ul class="list-group">
                                                                        @foreach($ticket->documents as $document)
                                                                            <li class="list-group-item">
                                                                                <a href="{{ Storage::url($document->document) }}" target="_blank">
                                                                                    {{ $document->publie_le ?? 'Document' }}
                                                                                </a>
                                                                            </li>
                                                                        @endforeach
                                                             </ul>
                                                          </div>
                                                       </div>
                                                    </div>
                                                 </div>
                                                    @else
                                                        <a href="#"
                                                            style="background-color: transparent; color: transparent; pointer-events: none; width:28px"
                                                            class="button-style">
                                                            <i class="fa"></i>
                                                        </a>
                                                    @endif
                                                @endcan
                                                @can('view ticket')
                                                    <a href="{{ route('user.showTicket', $ticket->id) }}"
                                                        style="background-color: #20595D;background-color 0.3s;
                                                        "onmouseover="this.style.backgroundColor='#3b767c ';"
                                                        onmouseout="this.style.backgroundColor='#20595D';"
                                                        class="button-style">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="#"
                                                        style="background-color: transparent; color: transparent; pointer-events: none; width:27px"
                                                        class="button-style">
                                                        <i class="fa"></i>
                                                    </a>
                                                    <a href="#"
                                                        style="background-color: transparent; color: transparent; pointer-events: none; width:27px"
                                                        class="button-style">
                                                        <i class="fa"></i>
                                                    </a>
                                                @endcan
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
                <div >
                    {{ $tickets->links() }}
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/fr.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            flatpickr("#startDateInput", {
                dateFormat: "Y/m/d",
                locale: "fr",
                onChange: filterTable
            });

            flatpickr("#endDateInput", {
                dateFormat: "Y/m/d",
                locale: "fr",
                onChange: filterTable
            });
        });

        function filterTable() {
            var idInput, typeInput, num_declarationInput, clientInput, agenceInput, statusInput,
                startDateInput, endDateInput, table, tr, td, i;

            idInput = document.getElementById("idInput").value;
            typeInput = document.getElementById("typeInput").value;
            num_declarationInput = document.getElementById("num_declarationInput").value;
            clientInput = document.getElementById("clientInput").value;
            agenceInput = document.getElementById("agenceInput").value;
            statusInput = document.getElementById("statusInput").value;
            startDateInput = document.getElementById("startDateInput").value;
            endDateInput = document.getElementById("endDateInput").value;

            table = document.getElementById("ticketTable");
            tr = table.getElementsByTagName("tr");

            for (i = 1; i < tr.length; i++) {
                var idCell = tr[i].getElementsByTagName("td")[0];
                var typeCell = tr[i].getElementsByTagName("td")[1];
                var num_declarationCell = tr[i].getElementsByTagName("td")[2];
                var clientCell = tr[i].getElementsByTagName("td")[3];
                var agenceCell = tr[i].getElementsByTagName("td")[5];
                var statusCell = tr[i].getElementsByTagName("td")[8];
                var createdCell = tr[i].getElementsByTagName("td")[10];

                if (idCell && typeCell && num_declarationCell && clientCell && agenceCell && statusCell &&
                    createdCell) {
                    var idText = idCell.textContent || idCell.innerText;
                    var typeText = typeCell.textContent || typeCell.innerText;
                    var num_declarationText = num_declarationCell.textContent || num_declarationCell.innerText;
                    var clientText = clientCell.textContent || clientCell.innerText;
                    var agenceText = agenceCell.textContent || agenceCell.innerText;
                    var statusText = statusCell.textContent || statusCell.innerText;
                    var createdText = createdCell.textContent || createdCell.innerText;

                    if (idText.indexOf(idInput) > -1 &&
                        typeText.indexOf(typeInput) > -1 &&
                        num_declarationText.indexOf(num_declarationInput) > -1 &&
                        clientText.indexOf(clientInput) > -1 &&
                        agenceText.indexOf(agenceInput) > -1 &&
                        statusText.indexOf(statusInput) > -1 &&
                        (!startDateInput || new Date(createdText) >= new Date(startDateInput)) &&
                        (!endDateInput || new Date(createdText) <= new Date(endDateInput))) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }

        function exportTickets() {
            document.getElementById('export_id').value = document.getElementById('idInput').value;
            document.getElementById('export_type').value = document.getElementById('typeInput').value;
            document.getElementById('export_num_declaration').value = document.getElementById('num_declarationInput').value;
            document.getElementById('export_client').value = document.getElementById('clientInput').value;
            document.getElementById('export_agence').value = document.getElementById('agenceInput').value;
            document.getElementById('export_status').value = document.getElementById('statusInput').value;
            document.getElementById('export_startDate').value = document.getElementById('startDateInput').value;
            document.getElementById('export_endDate').value = document.getElementById('endDateInput').value;

            document.getElementById('exportForm').submit();
        }
    </script>
    </div>
    </div>
    </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/js/lightbox.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</x-app-layout>
