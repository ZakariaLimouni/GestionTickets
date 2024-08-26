<?php

use Illuminate\Support\Facades\Storage;

?>
<x-app-layout>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/css/lightbox.min.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">


    <x-slot name="header">
        <h2 class="font-semibold text-xl text-black-800 dark:text-BLACK-200 leading-tight"
            style="display: inline-block; border-bottom: 3px solid #006622; padding-left: 8px;padding-right: 8px;">
            {{ __('détail Ticket') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-white-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-white-900 dark:text-white-100">
                    <div class="container mx-auto px-4">

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
                        <form method="POST" action="{{ route('user.updateTicket', $ticket->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="col-span-8 grid grid-cols-2 gap-4">
                                <!-- type_ticket_id -->
                                <div class="mt-1 "class="col-span-4">
                                    <x-input-label for="type_ticket_id" :value="__('Type de Ticket')" />
                                    <select id="type_ticket_id" name="type_ticket_id"
                                        class="block w-full px-4 py-2 mt-1 text-base text-black border border-gray-300 rounded-md shadow-sm focus:outline-none focus:border-indigo-500 focus:ring focus:ring-indigo-200 dark:text-black dark:border-gray-600 dark:bg-white dark:focus:border-gray-500 dark:focus:ring-gray-900">
                                        <option value="">Selectionner le type</option>
                                        @foreach ($TypeTickets as $TypeTicket)
                                            <option value="{{ $TypeTicket->id }}"
                                                {{ $ticket->type_ticket_id == $TypeTicket->id ? 'selected' : '' }}>
                                                {{ $TypeTicket->libelle }}</option>
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get('type_ticket_id')" class="mt-1" />
                                </div>
                                <!-- status -->
                                <div class="mt-1">
                                    <x-input-label for="status" :value="__('Status')" />
                                    <select id="status" name="status"
                                        class="block w-full px-4 py-2 mt-1 text-base text-black border border-gray-300 rounded-md shadow-sm focus:outline-none focus:border-indigo-500 focus:ring focus:ring-indigo-200 dark:text-black dark:border-gray-600 dark:bg-white dark:focus:border-gray-500 dark:focus:ring-gray-900">
                                        <option value="">Selectionner le Status</option>
                                        <option value="en_instance"
                                            {{ $ticket->status == 'en_instance' ? 'selected' : '' }}>
                                            en_instance
                                        </option>
                                    </select>
                                    <x-input-error :messages="$errors->get('status')" class="mt-1" />
                                </div>

                                <!-- num_declaration -->
                                <div class="mt-1">
                                    <x-input-label for="num_declaration" :value="__('num_declaration')" />
                                    <x-text-input id="num_declaration" class="block mt-1 w-full" type="text" name="num_declaration"
                                        value="{{ $ticket->num_declaration }}" required autofocus autocomplete="num_declaration" />
                                    <x-input-error :messages="$errors->get('num_declaration')" class="mt-1" />
                                </div>
                                <!-- agence_id -->
                                <div class="mt-1">
                                    <x-input-label for="agence_id" :value="__('Agence')" />
                                    <select id="agence_id" name="agence_id"
                                        class="block w-full px-4 py-2 mt-1 text-base text-black border border-gray-300 rounded-md shadow-sm focus:outline-none focus:border-indigo-500 focus:ring focus:ring-indigo-200 dark:text-black dark:border-gray-600 dark:bg-white dark:focus:border-gray-500 dark:focus:ring-gray-900">
                                        <option value="">Selectionner Agence</option>
                                        @foreach ($agences as $agence)
                                            <option value="{{ $agence->id }}"
                                                {{ $ticket->agence_id == $agence->id ? 'selected' : '' }}>
                                                {{ $agence->agence }}</option>
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get('agence_id')" class="mt-1" />
                                </div>
                                <!-- client -->
                                <div class="mt-1">
                                    <x-input-label for="client" :value="__('Nom Client')" />
                                    <x-text-input id="client" class="block mt-1 w-full" type="text" name="client"
                                        value="{{ $ticket->client }}" required autofocus autocomplete="client" />
                                    <x-input-error :messages="$errors->get('client')" class="mt-2" />
                                </div>
                                <!-- Code client -->
                                <div class="mt-1">
                                    <x-input-label for="code_client" :value="__('Code Client')" />
                                    <x-text-input id="code_client" class="block mt-1 w-full" type="text"
                                        name="code_client" value="{{ $ticket->code_client }}" required autofocus
                                        autocomplete="code_client" />
                                    <x-input-error :messages="$errors->get('code_client')" class="mt-2" />
                                </div>

                                <!-- description -->
                                <div class="mt-1">
                                    <x-input-label for="description" :value="__('Description')" />
                                    <textarea id="description" style="resize: none"
                                        class="block mt-1 w-full h-20 px-4 py-2 border border-gray-300 rounded-md shadow-sm resize-none focus:outline-none focus:border-indigo-500 focus:ring focus:ring-indigo-200 dark:text-black dark:border-gray-600 dark:bg-white dark:focus:border-gray-500 dark:focus:ring-gray-900"
                                        name="description" required autofocus autocomplete="description">{{ $ticket->description }}</textarea>
                                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                                </div>
                                <!-- resolution -->
                                <div class="mt-1">
                                    <x-input-label for="resolution" :value="__('Commenter Service Modification')" />
                                    <textarea id="resolution" style="resize: none"
                                        class="block mt-1 w-full h-20 px-4 py-2 border border-gray-300 rounded-md shadow-sm resize-none focus:outline-none focus:border-indigo-500 focus:ring focus:ring-indigo-200 dark:text-black dark:border-gray-600 dark:bg-white dark:focus:border-gray-500 dark:focus:ring-gray-900"
                                        name="resolution"  autofocus autocomplete="resolution">{{ $ticket->resolution }}</textarea>
                                    <x-input-error :messages="$errors->get('resolution')" class="mt-2" />
                                </div>

                                <!-- assigned_to -->
                                <div class="mt-1">
                                    <x-input-label for="assigned_to" :value="__('Assigné à')" />
                                    <select id="assigned_to" name="assigned_to"
                                        class="block w-full px-4 py-2 mt-1 text-base text-black border border-gray-300 rounded-md shadow-sm focus:outline-none focus:border-indigo-500 focus:ring focus:ring-indigo-200 dark:text-black dark:border-gray-600 dark:bg-white dark:focus:border-gray-500 dark:focus:ring-gray-900">
                                        <option value="">Sélectionner un utilisateur</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}"
                                                {{ $ticket->assigned_to == $user->id ? 'selected' : '' }}>
                                                {{ $user->agence->agence . '/' . $user->name . ' ' . $user->Prenom }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get('assigned_to')" class="mt-2" />
                                </div>
                            </div>
                            <div class="flex items-center justify-end mt-1">
                                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                                    href="{{ route('user.gestionTicket') }}">
                                    {{ __('Annuler') }}
                                </a>

                                <x-primary-button class="ms-4" style="background-color:green; color:white;">
                                    {{ __('Enregistrer') }}
                                </x-primary-button>
                            </div>
                        </form>
                        <form method="POST" action="{{ route('user.updateDocTicket', $ticket->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <!-- Document -->
                            <div class="mt-1">
                                <x-input-label for="document" :value="__('Choisissez un document ')" />
                                <input id="document" type="file" name="document" accept="image/*">
                                <x-input-error :messages="$errors->get('document')" class="mt-2" />
                            </div>
                            <!-- type_document_id -->
                            <div class="mt-1 "class="col-span-4">
                                <x-input-label for="type_document_id" :value="__('Type de Document')" />
                                <select id="type_document_id" name="type_document_id"
                                    class="block w-full px-4 py-2 mt-1 text-base text-black border border-gray-300 rounded-md shadow-sm focus:outline-none focus:border-indigo-500 focus:ring focus:ring-indigo-200 dark:text-black dark:border-gray-600 dark:bg-white dark:focus:border-gray-500 dark:focus:ring-gray-900">
                                    <option value="">Selectionner le type</option>
                                    @foreach ($TypeDocuments as $TypeDocument)
                                        <option value="{{ $TypeDocument->id }}">{{ $TypeDocument->libelle }}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('type_document_id')" class="mt-1" />
                            </div><br>
                            <x-primary-button class="ms-4" style="background-color:green; color:white;">
                                {{ __('Créer Note') }}
                            </x-primary-button><br>
                        </form><br>
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
                                                        <a href="{{ Storage::url($document->document) }} "target="_blank"
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
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/js/lightbox.min.js"></script>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>
