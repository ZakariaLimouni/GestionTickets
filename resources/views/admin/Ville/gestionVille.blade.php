<?php
use App\Models\Ville;
$villes = Ville::paginate(5);
?>

<x-app-layout>

    <head>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
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




            .add-city-button {
                background-color: #016C01;
                color: white;
                border: none;
                padding: 0.5rem 1rem;
                border-radius: 0.25rem;
                cursor: pointer;
            }

            .add-city-button:hover {
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

            .dataTables_wrapper .dataTables_paginate .paginate_button {
                padding: 5px 10px;
                margin-left: 2px;
                border: 1px solid #ccc;
                border-radius: 3px;
                background-color: #faf0e6;
                color: black;
            }

            .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
                background-color: #2f1b0c;
                color: white;
            }

            .dataTables_wrapper .dataTables_paginate .paginate_button.current {
                background-color: #03224c;
                color: white;
            }

            .dataTables_wrapper .dataTables_paginate .paginate_button.disabled {
                background-color: #ccc;
                color: #666;
                cursor: default;
            }

            .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover {
                background-color: #ccc;
                color: #666;
            }

           
        </style>
    </head>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-black-800 dark:text-BLACK-200 leading-tight"
            style="display: inline-block; border-bottom: 3px solid #006622; padding-left: 8px; padding-right: 8px;">
            {{ __('Gestion des Villes') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-white-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-white-900 dark:text-white-100">
                    <div class="container mx-auto px-4">
                        <div class="flex justify-between items-center mb-4">
                            <h2 class="text-lg font-semibold"
                                style="display: inline-block; border-bottom: 3px solid #006622; padding-left: 8px; padding-right: 8px;">
                                Liste des Villes</h2>
                            <button id="createCityButton" class="add-city-button toggle-element">
                                <span class="toggle-element"> <i class="fas fa-plus icon-plus"
                                        style="padding: 5px;"></i>
                                    {{ __('Ajouter') }}
                                </span>
                            </button>
                        </div>

                        <table>
                            <thead>
                                <tr class="header-row">
                                    <th style="text-align:center;">Code de la Ville</th>
                                    <th style="text-align:center;">Nom de la Ville</th>
                                    <th style="text-align:center;">Le status de la Ville</th>
                                    <th style="text-align:center;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($villes as $ville)
                                    <tr class="{{ $loop->iteration % 2 == 0 ? 'even' : 'odd' }}">
                                        <td>{{ $ville->codeVille }}</td>
                                        <td>{{ $ville->ville }}</td>
                                        <td>{{ $ville->status }}</td>
                                        <td class="table-buttons">
                                            <div style="display: flex; align-items: center;">
                                                <i id="modifyButton_{{ $ville->id }}" class="fas fa-pencil-alt icon-modify"
                                                    onclick="toggleEditForm('{{ $ville->id }}')"
                                                    style="font-size:20px; background-color: #075719; color: white; padding: 7px; border-radius: 3px; width:50px; height:40px; text-align:center;display: flex; justify-content: center; align-items: center; "></i>
                                                <form action="{{ route('admin.deleteVille', $ville->id) }}"
                                                    method="POST" onsubmit="return confirmDelete()">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="icon-delete">
                                                        <i class="fas fa-trash-alt"
                                                            style="font-size:20px;  background-color: #E20D0D; color: white; padding: 7px; border-radius: 3px; width:50px; height:40px; text-align:center; display: flex; justify-content: center; align-items: center; "></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>



                                    </tr>
                                    <tr id="editCityFormRow_{{ $ville->id }}" style="display: none;">
                                        <form id="editCityForm_{{ $ville->id }}" method="POST"
                                            action="{{ route('admin.updateVille', $ville->id) }}">
                                            @csrf
                                            @method('PUT')
                                            <td>
                                                <div>
                                                    <x-text-input id="codeVille" class="block mt-1 w-full"
                                                        type="number" name="codeVille" value="{{ $ville->codeVille }}"
                                                        required autofocus autocomplete="codeVille" />
                                                    <x-input-error :messages="$errors->get('codeVille')" class="mt-2" />
                                                </div>
                                            </td>
                                            <td>
                                                <div>
                                                    <x-text-input id="ville" class="block mt-1 w-full"
                                                        type="text" name="ville" value="{{ $ville->ville }}"
                                                        required autofocus autocomplete="ville" />
                                                    <x-input-error :messages="$errors->get('ville')" class="mt-2" />
                                                </div>
                                            </td>
                                            <td>
                                                <div class="flex items-center justify-center">
                                                    <select id="status" name="status"
                                                        class="block w-full px-4 py-2 mt-1 text-base text-black border border-gray-300 rounded-md shadow-sm focus:outline-none focus:border-indigo-500 focus:ring focus:ring-indigo-200 dark:text-black dark:border-gray-600 dark:bg-white dark:focus:border-gray-500 dark:focus:ring-gray-900">
                                                        <option value="">Selectionner le Status</option>
                                                        <option value="active"
                                                            {{ $ville->status == 'active' ? 'selected' : '' }}>Active
                                                        </option>
                                                        <option value="inactive"
                                                            {{ $ville->status == 'inactive' ? 'selected' : '' }}>
                                                            Inactive
                                                        </option>
                                                    </select>
                                                    <x-input-error :messages="$errors->get('status')" class="mt-2" />
                                                </div>
                                            </td>

                                            <td style="border: none;">
                                                <div class="flex items-center justify-center">
                                                    <x-primary-button id="cancelButton_{{ $ville->id }}"
                                                        style="background-color:#F73419; color:white;margin-right: 10px; width:500"
                                                        onclick="toggleEditForm('{{ $ville->id }}')"
                                                        type="button">Annuler

                                                    </x-primary-button>

                                                    <x-primary-button
                                                        style="background-color:#006622; color:white;">Enregistrer

                                                    </x-primary-button>

                                                </div>
                                            </td>
                                        </form>
                                    </tr>
                                @endforeach
                                <tr id="createCityFormRow" style="display: none;">
                                    <form id="createCityForm" method="POST"
                                        action="{{ route('ajouterVille.store') }}">
                                        @csrf
                                        <td>
                                            <div>
                                                <x-input-label for="codeVille" :value="__('Code de Ville')" />
                                                <x-text-input id="codeVille" class="block mt-1 w-full" type="number"
                                                    name="codeVille" :value="old('codeVille')" required autofocus
                                                    autocomplete="codeVille" />
                                                <x-input-error :messages="$errors->get('codeVille')" class="mt-2" />
                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                <x-input-label for="ville" :value="__('La Ville')" />
                                                <x-text-input id="ville" class="block mt-1 w-full" type="text"
                                                    name="ville" :value="old('ville')" required autofocus
                                                    autocomplete="ville" />
                                                <x-input-error :messages="$errors->get('ville')" class="mt-2" />
                                            </div>
                                        </td>
                                        <td>
                                            <div class="mt-4">
                                                <x-input-label for="status" :value="__('Le Status')" />
                                                <select id="status" name="status"
                                                    class="block w-full px-4 py-2 mt-1 text-base text-black border border-gray-300 rounded-md shadow-sm focus:outline-none focus:border-indigo-500 focus:ring focus:ring-indigo-200 dark:text-black dark:border-gray-600 dark:bg-white dark:focus:border-gray-500 dark:focus:ring-gray-900">
                                                    <option value="">Selectionner le Status</option>
                                                    <option value="active">Active</option>
                                                    <option value="inactive">Inactive</option>
                                                </select>
                                                <br>
                                                <x-input-error :messages="$errors->get('status')" class="mt-2" />
                                            </div>
                                        </td>
                                        <td>
                                            <div class="flex items-center justify-center">
                                                <x-primary-button id="cancelCreateVilleButton"
                                                    style="background-color:#f44336; color:white;margin-right: 10px;"
                                                    onclick="toggleCreateForm()" type="button">
                                                    {{ __('Annuler') }}
                                                </x-primary-button>
                                                <x-primary-button style="background-color:green; color:white;">
                                                    {{ __('Enregistrer') }}
                                                </x-primary-button>
                                            </div>
                                        </td>
                                    </form>
                                </tr>
                            </tbody>
                        </table>
                        <div class="pagination">
                            <ul>
                                {{ $villes->links() }} </ul>
                        </div>
                    </div>

                    <script>
                        const toggleElement = document.querySelector('#createCityButton .toggle-element');

                        document.getElementById('createCityButton').addEventListener('click', function() {
                            const formRow = document.getElementById('createCityFormRow');
                            var addButton = document.getElementById('createCityButton');

                            if (formRow.style.display === 'none') {
                                formRow.style.display = 'table-row';
                                addButton.style.display = 'none'; // Hide both icon and text
                            } else {
                                formRow.style.display = 'none';
                                addButton.style.display = 'inline-block'; // Display both icon and text
                            }
                        });

                        function toggleCreateForm() {
                            var formRow = document.getElementById('createCityFormRow');
                            var addButton = document.getElementById('createCityButton');

                            if (formRow.style.display === 'none') {
                                formRow.style.display = 'table-row';
                                addButton.style.display = 'none'; // Hide the icon
                            } else {
                                formRow.style.display = 'none';
                                addButton.style.display = 'inline-block'; // Display the icon
                            }
                        }

                        function toggleEditForm(villeId) {
                            var editFormRow = document.getElementById('editCityFormRow_' + villeId);
                            var modifyButton = document.getElementById('modifyButton_' + villeId);
                            var cancelButton = document.getElementById('cancelButton_' + villeId);

                            if (editFormRow.style.display === 'none') {
                                editFormRow.style.display = 'table-row';
                                modifyButton.style.display = 'none';
                                cancelButton.style.display = 'block';
                            } else {
                                editFormRow.style.display = 'none';
                                modifyButton.style.display = 'block';
                                cancelButton.style.display = 'none';
                            }
                        }

                        function confirmDelete() {
                            return confirm("Êtes-vous sûr de vouloir supprimer cette ville?");
                        }
                    </script>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
