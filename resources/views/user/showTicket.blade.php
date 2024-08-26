<x-app-layout>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/css/lightbox.min.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            color: #333;
            margin: 0;
            padding: 0;
        }

        table {
            width: 100%;
            border: 1px solid;
            border-radius: 5px;
            margin-bottom: 1rem;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 0.75rem;
            border-bottom: 1px solid #e2e8f0;
        }

        tr.even {
            background-color: #F0F7F5;
        }

        tr.odd {
            background-color: white;
        }




        .add-TypeTicket-button {
            background-color: #016C01;
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 0.25rem;
            cursor: pointer;
        }

        .add-TypeTicket-button:hover {
            background-color: #45a049;
        }

        .icon-add {
            margin-right: 0.5rem;
        }

        .icon-modify,
        .icon-delete {
            margin-right: 0.5rem;
            color: #718096;
            cursor: pointer;
        }

        .header-row {
            background-color: #E1F1DF;
            /* Couleur de fond des en-têtes */
            font-weight: bold;
            /* Police en gras pour les en-têtes */
            justify-content: center;
            /* Centrer horizontalement le contenu */
        }
    </style>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-black-800 dark:text-black-200 leading-tight"
            style="display: inline-block; border-bottom: 3px solid #006622; padding-left: 8px; padding-right: 8px;">
            {{ __('détail Ticket') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-white-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-white-900 dark:text-white-100">
                    <div class="container mx-auto px-4">
                        
                        <div class="grid grid-cols-2 gap-2">
                            
                            <div class="font-semibold text-sm py-1 px-2 rounded"
                                style="background-color:#086b29;color:white">N° Ticket:</div>
                            <div class="font-normal text-sm">{{ $ticket->id }}</div>

                            <div class="font-semibold text-sm py-1 px-2 rounded"
                                style="background-color:#086b29;color:white">Type de Ticket:</div>
                            <div class="font-normal text-sm">{{ $ticket->type_ticket->libelle }}</div>

                            <div class="font-semibold text-sm py-1 px-2 rounded"
                                style="background-color:#086b29;color:white">Status:</div>
                            <div class="font-normal text-sm">{{ $ticket->status }}</div>

                            <div class="font-semibold text-sm py-1 px-2 rounded"
                                style="background-color:#086b29;color:white">num_declaration:</div>
                            <div class="font-normal text-sm">{{ $ticket->num_declaration }}</div>

                            <div class="font-semibold text-sm py-1 px-2 rounded"
                                style="background-color:#086b29;color:white">Agence:</div>
                            <div class="font-normal text-sm">{{ $ticket->agence->agence }}</div>

                            <div class="font-semibold text-sm py-1 px-2 rounded"
                                style="background-color:#086b29;color:white">Client:</div>
                            <div class="font-normal text-sm">{{ $ticket->client }}</div>

                            <div class="font-semibold text-sm py-1 px-2 rounded"
                                style="background-color:#086b29;color:white">Client ID:</div>
                            <div class="font-normal text-sm">{{ $ticket->code_client }}</div>

                            <div class="font-semibold text-sm py-1 px-2 rounded"
                                style="background-color:#086b29;color:white">Description:</div>
                            <div class="font-normal text-sm">
                                <textarea disabled style="resize: none; width:300px; height:66px">{{ $ticket->description }}</textarea>
                            </div>

                            <div class="font-semibold text-sm py-1 px-2 rounded"
                                style="background-color:#086b29;color:white">Resolution:</div>
                            <div class="font-normal text-sm">
                                <textarea disabled style="resize: none;width:300px; height:66px">{{ $ticket->resolution }}</textarea>
                            </div>

                            <div class="font-semibold text-sm py-1 px-2 rounded"
                                style="background-color:#086b29;color:white">Assigné à</div>
                            <div class="font-normal text-sm">@php
                                $user = App\Models\User::find($ticket->assigned_to);
                            @endphp

                                @if ($user)
                                    {{ $user->agence->agence . '/' . $user->name . ' ' . $user->Prenom }}
                                @endif
                            </div>

                            <div class="font-semibold text-sm py-1 px-2 rounded"
                                style="background-color:#086b29;color:white">Date de Creation:</div>
                            <div class="font-normal text-sm">{{ $ticket->created_at }}</div>

                            <div class="font-semibold text-sm py-1 px-2 rounded"
                                style="background-color:#086b29;color:white">Date Clôture:</div>
                            <div class="font-normal text-sm">
                                @if($ticket->date_cloture)
                                {{ $ticket->date_cloture }}
                                @else
                                le ticket n'est pas encore Clôturé
                                @endif
                                </div>
                            <div class="font-semibold text-sm py-1 px-2 rounded"
                                style="background-color:#086b29;color:white;">La Clôture eat fait par :</div>
                            <div class="font-normal text-sm">
                                @if($ticket->cloture_creator)
                                {{ $ticket->cloture_creator }}</div>
                                @else
                                le ticket n'est pas encore Clôturé
                                @endif
                        </div>
                    </div>
                    <br>    
                    @if (!$ticket->documents->isEmpty())
                    <h2 class="font-semibold text-xl text-black-800 dark:text-BLACK-200 leading-tight"
                        style="display: inline-block; border-bottom: 3px solid #006622; padding-left: 8px; padding-right: 8px;">
                        {{ __('list des documents:') }}
                    </h2><br>
                    <br>
                    <table>
                        <thead>
                            <tr class="header-row">
                                <th style="text-align:center;">type</th>
                                <th style="text-align:center;">Publié Le</th>
                                <th style="text-align:center;">Agence</th>
                                <th style="text-align:center;">User</th>
                                <th style="text-align:center;">document</th>
                                <th style="text-align:center;">annuler</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ticket->documents()->get() as $document)

                                <tr>
                                    <td>{{ $document->type_document->libelle }}</td>
                                    <td>{{ $document->publie_le }}</td>
                                    <td>{{ explode('/', $document->document_creator)[0] }}</td>
        <td>{{ explode('/', $document->document_creator)[1] }}</td>
                                    <td>
                                        @if ($document->document)
                                            <div class="lightbox-container">
                                                <a href="{{ Storage::url($document->document) }}"target="_blank"
                                                    data-lightbox="document" class="button-style">
                                                    <i class="fas fa-eye"
                                                        style="font-size:20px;background-color: #20595D;color: white;border-radius: 3px;width:50px; height:40px;text-align:center;display: flex; justify-content: center; align-items: center;background-color 0.3s;
                                                "onmouseover="this.style.backgroundColor='#3b767c ';"
                                                        onmouseout="this.style.backgroundColor='#20595D';"></i>
                                                </a>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="table-buttons">
                                        <div style="display: flex; align-items: center;">
                                            <form action="{{ route('user.deleteDocument', $document->id) }}"
                                                method="POST" onsubmit="return confirmDelete()">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="icon-delete">
                                                    <i class="fas fa-trash-alt"
                                                        style="font-size:20px;  background-color: #E20D0D; color: white; padding: 7px; border-radius: 3px; width:50px; height:40px; text-align:center; display: flex; justify-content: center; align-items: center;background-color 0.3s;
                                                        "onmouseover="this.style.backgroundColor='#cc0000 ';"
                                                        onmouseout="this.style.backgroundColor='#E20D0D';"></i>
                                                </button>
                                                <script>
                                                    function confirmDelete() {
                                                        return confirm("Êtes-vous sûr de vouloir supprimer cette document?");
                                                    }
                                                </script>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
                        <div class="flex items-center justify-end mt-1" >
                            <a class="underline text-m text-black-600 dark:text-black-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                            style="background-color: rgb(240, 15, 15);width:120px;text-align:center;color:white;margin-left:50px;"  href="{{ route('user.gestionTicket') }}">
                                {{ __('Quiter') }}
                            </a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>